# EuroToll — 1:1 visual build

Upload all files to a PHP 8.1+ FastPanel document root.

## Payment
Edit `config.php`:
- `payment.url`
- `payment.amount_param`
- `payment.currency_param`
- `payment.order_param`
- `discount_percent` (currently 15)

Checkout sends the discounted amount to the configured payment endpoint as:
`?amount=...&currency=...&order=...`

## Data
Fixed-price entries are stored in `data/tolls.php` and include source URLs. Route-based systems remain dynamic rather than inventing a price.

## Visual assets
All photographic/illustration assets used by the page are individual PNG/JPG files under `assets/images/`, extracted from the supplied reference image. No SVG assets are used.

## Important
The site is an independent purchase interface. It is not ASFINAG or another national road authority. Actual vignette issuance requires an authorised reseller/operator API or fulfillment integration.
