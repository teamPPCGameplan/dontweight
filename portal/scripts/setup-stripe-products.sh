#!/bin/bash
# ============================================================
# Don't Weight — Stripe Products & Prices Setup Script
# ============================================================
# Run this script ONCE to create all products and prices in Stripe.
# It will output the price IDs which need to be added to:
#   1. portal/src/data/treatments.js (STRIPE_PRICES mapping)
#   2. Netlify environment variables (if needed)
#
# Usage: bash scripts/setup-stripe-products.sh
# ============================================================

STRIPE_KEY="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"

echo "========================================"
echo "Step 1: Listing existing products"
echo "========================================"

curl -s https://api.stripe.com/v1/products?limit=100 \
  -u "$STRIPE_KEY:" | python3 -c "
import sys,json
d=json.load(sys.stdin)
if 'error' in d:
    print('ERROR:', d['error']['message'])
    sys.exit(1)
for p in d.get('data',[]):
    print(f\"  {p['id']} | {p['name']} | {'active' if p.get('active') else 'inactive'}\")
if not d.get('data'):
    print('  (no products found)')
"

echo ""
echo "========================================"
echo "Step 2: Listing existing prices"
echo "========================================"

curl -s "https://api.stripe.com/v1/prices?limit=100&expand[]=data.product" \
  -u "$STRIPE_KEY:" | python3 -c "
import sys,json
d=json.load(sys.stdin)
if 'error' in d:
    print('ERROR:', d['error']['message'])
    sys.exit(1)
for p in d.get('data',[]):
    amount = p.get('unit_amount',0)/100
    currency = p.get('currency','')
    recurring = p.get('recurring')
    interval = recurring.get('interval','') if recurring else 'one-time'
    product = p.get('product',{})
    name = product.get('name','') if isinstance(product, dict) else product
    print(f\"  {p['id']} | £{amount:.0f} | {interval} | {name}\")
if not d.get('data'):
    print('  (no prices found)')
"

echo ""
echo "========================================"
echo "Step 3: Creating missing products and prices"
echo "========================================"
echo "Creating products if they don't already exist..."
echo ""

# Function to create a product and price, outputting the price ID
create_product_price() {
  local name="$1"
  local amount="$2"  # in pence
  local interval="$3"  # 'month' or 'year' or 'one-time'
  local lookup_key="$4"
  local metadata_treatment="$5"
  local metadata_dose="$6"

  echo "Creating: $name (£$((amount/100)) $interval)..."

  # Create product
  PRODUCT=$(curl -s https://api.stripe.com/v1/products \
    -u "$STRIPE_KEY:" \
    -d "name=$name" \
    -d "metadata[treatment]=$metadata_treatment" \
    -d "metadata[dose]=$metadata_dose")

  PRODUCT_ID=$(echo "$PRODUCT" | python3 -c "import sys,json; print(json.load(sys.stdin).get('id','ERROR'))")

  if [ "$PRODUCT_ID" = "ERROR" ]; then
    echo "  ERROR creating product: $(echo "$PRODUCT" | python3 -c "import sys,json; print(json.load(sys.stdin).get('error',{}).get('message','unknown'))")"
    return
  fi

  # Create price
  if [ "$interval" = "one-time" ]; then
    PRICE=$(curl -s https://api.stripe.com/v1/prices \
      -u "$STRIPE_KEY:" \
      -d "product=$PRODUCT_ID" \
      -d "unit_amount=$amount" \
      -d "currency=gbp" \
      -d "lookup_key=$lookup_key" \
      -d "metadata[treatment]=$metadata_treatment" \
      -d "metadata[dose]=$metadata_dose")
  else
    PRICE=$(curl -s https://api.stripe.com/v1/prices \
      -u "$STRIPE_KEY:" \
      -d "product=$PRODUCT_ID" \
      -d "unit_amount=$amount" \
      -d "currency=gbp" \
      -d "recurring[interval]=$interval" \
      -d "lookup_key=$lookup_key" \
      -d "metadata[treatment]=$metadata_treatment" \
      -d "metadata[dose]=$metadata_dose")
  fi

  PRICE_ID=$(echo "$PRICE" | python3 -c "import sys,json; print(json.load(sys.stdin).get('id','ERROR'))")
  echo "  Product: $PRODUCT_ID"
  echo "  Price:   $PRICE_ID"
  echo "  Lookup:  $lookup_key"
  echo ""
}

# ---- Mounjaro doses (monthly recurring) ----
create_product_price "Mounjaro 2.5mg"  14900 "month" "mounjaro-2.5mg"  "mounjaro" "2.5mg"
create_product_price "Mounjaro 5mg"    14900 "month" "mounjaro-5mg"    "mounjaro" "5mg"
create_product_price "Mounjaro 7.5mg"  16900 "month" "mounjaro-7.5mg"  "mounjaro" "7.5mg"
create_product_price "Mounjaro 10mg"   18900 "month" "mounjaro-10mg"   "mounjaro" "10mg"
create_product_price "Mounjaro 12.5mg" 20900 "month" "mounjaro-12.5mg" "mounjaro" "12.5mg"
create_product_price "Mounjaro 15mg"   22900 "month" "mounjaro-15mg"   "mounjaro" "15mg"

# ---- Wegovy doses (monthly recurring) ----
create_product_price "Wegovy 0.25mg" 14900 "month" "wegovy-0.25mg" "wegovy" "0.25mg"
create_product_price "Wegovy 0.5mg"  14900 "month" "wegovy-0.5mg"  "wegovy" "0.5mg"
create_product_price "Wegovy 1mg"    16900 "month" "wegovy-1mg"    "wegovy" "1mg"
create_product_price "Wegovy 1.7mg"  19900 "month" "wegovy-1.7mg"  "wegovy" "1.7mg"
create_product_price "Wegovy 2.4mg"  22900 "month" "wegovy-2.4mg"  "wegovy" "2.4mg"

# ---- Health Checks ----
# Standard: £599 one-off + £1000/year
create_product_price "Health Check Standard (Initial)" 59900 "one-time" "hc-standard-initial" "health-check" "standard"
create_product_price "Health Check Standard (Annual)"  100000 "year"    "hc-standard-annual"  "health-check" "standard"

# Premium: £999 one-off + £1700/year
create_product_price "Health Check Premium (Initial)" 99900  "one-time" "hc-premium-initial" "health-check" "premium"
create_product_price "Health Check Premium (Annual)"  170000 "year"     "hc-premium-annual"  "health-check" "premium"

echo ""
echo "========================================"
echo "Step 4: Creating Payment Links for WordPress"
echo "========================================"
echo ""
echo "After running the above, you need to create payment links."
echo "Use the price IDs printed above to run:"
echo ""
echo "For each price ID (PRICE_ID), run:"
echo '  curl -s https://api.stripe.com/v1/payment_links \'
echo "    -u \"$STRIPE_KEY:\" \\"
echo '    -d "line_items[0][price]=PRICE_ID" \'
echo '    -d "line_items[0][quantity]=1"'
echo ""
echo "========================================"
echo "DONE. Copy the price IDs above into:"
echo "  portal/src/data/treatments.js (STRIPE_PRICES object)"
echo "========================================"
