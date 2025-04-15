# QLS Assessment

## Install

### step 1: Clone repo

```bash
git clone git@github.com:GerardProgrammeert/qls.git
cd qls
```

### Step 2 Build app
Run the next cmd in the root of the app
```
make build
make up
make in-root //log in as root in the container
make install //run in the container
npm run dev //run in the container
```

### step 3  Configure app
Open .env file and set the following env-vars
```
QLS_API_USER=
QLS_API_PWD=
QLS_API_COMPANY_ID=
QLS_API_BRAND_ID=
```
It’s possible the permissions are not set correctly. If that’s not the case, run this outside the container:
```
 chmod developer:developer .env
```

## Usage
**Instructions for Registering a QLS Shipment:**

- Open `localhost:8080/orders` to view all orders.
- Navigate to `localhost:8080/orders/{order}/edit` to edit a specific order and register the QLS shipment.
- On the *Edit Order* page, click the **"Submit QLS Shipment"** button to register the shipment.
- This action triggers an API call to QLS to register the shipment.
- If the API call is successful, background jobs will be triggered to generate a PDF file containing package and shipment details.
