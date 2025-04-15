# QLS Assessment

## Install

### step 1: download and install
run the following cmds in your terminal
```bash
git clone git@github.com:GerardProgrammeert/qls.git
cd qls
make build in-root install
```

### step 2 Configurate
Open .env file and set the following env-vars
```
QLS_API_USER=
QLS_API_PWD=
QLS_API_COMPANY_ID=
QLS_API_BRAND_ID=
```

### Step 3 Build & run app
```
make build
make in-root
npm run dev
```
## Usage
**Instructions for Registering a QLS Shipment:**

- Open `localhost:8080/orders` to view all orders.
- Navigate to `localhost:8080/orders/{order}/edit` to edit a specific order and register the QLS shipment.
- On the *Edit Order* page, click the **"Submit QLS Shipment"** button to register the shipment.
- This action triggers an API call to QLS to register the shipment.
- If the API call is successful, background jobs will be triggered to generate a PDF file containing package and shipment details.

