<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreOrderAction;
use App\Actions\UpdateOrderAction;
use App\Enums\ContactTypeEnum;
use App\Http\Requests\OrderRequest;
use App\Jobs\DownloadShipmentLabelJob;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use BeezMaster\QLSClient\QLSService;
use BeezMaster\QLSClient\Repositories\ProductRepository;
use BeezMaster\QLSClient\Requests\ValueObjects\ShipmentValueObject;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->with(['receiverContact'])->paginate(20);

        return view('order.index', compact(['orders']));
    }

    public function create(ProductRepository $productRepo): View
    {
        $productCombinations =  $productRepo->getCombinationsByProduct(2);
        $products = $this->getOrderedProducts();

        return view('order.create', compact('productCombinations', 'products'));
    }

    public function store(OrderRequest $request): View|RedirectResponse
    {
        $shipment = ShipmentValueObject::hydrate($this->typeCastValidated($request->validated()));
        $order = (new StoreOrderAction())->execute($shipment);
        try {
            $this->sendShipment($shipment, $order);
        } catch (Exception $e) {
            if ($validationErrors = $this->handleValidationErrors($e)) {
                return redirect()->route('order.edit', $order)->withErrors($validationErrors);
            }
        }

        return redirect()->route('order.index');
    }

    public function edit(Order $order): View
    {
        $order->load(['orderLines','contacts']);
        $products = $order->orderLines->map(function (OrderLine $orderLine) {
            return array_merge($orderLine->toArray(), ['total' => $orderLine->amount * $orderLine->price_per_unit]);
        });

        $productRepo = app()->make(ProductRepository::class);
        $productCombinations =  $productRepo->getCombinationsByProduct(2);
        $receiver_contact = $order->contacts->where('type', '=', ContactTypeEnum::RECEIVER)->first();

        return view(
            'order.edit',
            compact('products', 'receiver_contact', 'order', 'productCombinations')
        );
    }

    public function update(OrderRequest $request, Order $order): View|RedirectResponse
    {
        $shipment = ShipmentValueObject::hydrate($this->typeCastValidated($request->validated()));

        try {
            $this->sendShipment($shipment, $order);
        } catch (Exception $e) {
            if ($validationErrors = $this->handleValidationErrors($e)) {
                return redirect()->back()->withErrors($validationErrors)->withInput();
            }
        }

        return redirect()->route('order.index');
    }

    /**
     * @param array<int, array<string, mixed>>
     */
    private function getOrderedProducts(): array
    {
        /** @var Collection<int, Product> $randomRecords */
        $randomRecords = Product::query()->inRandomOrder()->limit(rand(1, 8))->get();

        return $randomRecords->map(function ($item) {
            $amount = rand(1, 10);
            /** @var Product $item */
            return [
                'id' => $item->id,
                'amount' => $amount,
                'name' => $item->name,
                'price_per_unit' => $item->price_per_unit / 100,
                'total' => ($item->price_per_unit / 100) * $amount,
            ];
        })->toArray();
    }

    private function typeCastValidated(array $validated): array
    {
        $productCombinationId = (int) data_get($validated, 'product_combination_id');
        $products = collect(data_get($validated, 'shipment_products'))->map(function ($product) {
            return [
                'amount' => (int) $product['amount'],
                'price_per_unit' => (float) $product['price_per_unit'],
                'name' => $product['name'],
            ];
        })->toArray();

        $validated['shipment_products'] = $products;
        $validated['product_combination_id'] = $productCombinationId;
        $validated['brand_id'] = config('qls-client.brand_id');
        $validated['receiver_contact']['country'] = 'NL';

        return $validated;
    }

    /**
     *@return array<string, mixed>
     */
    public function handleValidationErrors(Exception $exception): ?MessageBag
    {
        $validationErrors = null;
        if (method_exists($exception, 'getResponse') && $exception->getResponse()) {
            $response = $exception->getResponse();
            $json = json_decode((string)$response->getBody(), true);
            $errors = data_get($json, 'errors') ?? [];

            $parsedErrors = [];
            foreach ($errors as $fields) {
                foreach ($fields as $key => $errors) {
                    $parsedErrors[$key] = implode(',', $errors);
                }
            }
            $validationErrors = new MessageBag([
                $parsedErrors
            ]);
        }

        return $validationErrors;
    }

    private function sendShipment(ShipmentValueObject $shipment, Order $order): void
    {
        $service = app()->make(QLSService::class);

        $response = $service->postShipment(config('qls-client.company_id'), $shipment);
        /** @var \BeezMaster\QLSClient\Responses\ValueObjects\ShipmentValueObject $shipment */
        $shipment =  $response->getValueObject();
        $order = (new UpdateOrderAction())->execute($order->id, $shipment);

        DownloadShipmentLabelJob::dispatch($order->id);
    }
}
