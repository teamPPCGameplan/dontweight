// ============================================================
// Stripe Price IDs — replace with actual IDs after running
// scripts/setup-stripe-products.sh or from Stripe Dashboard
// ============================================================
// To get your price IDs, run:
//   curl -s "https://api.stripe.com/v1/prices?limit=100" \
//     -u "rk_live_...:" | python3 -c "import sys,json; ..."
// Or check the Stripe Dashboard > Products > Prices
// ============================================================

export const STRIPE_PRICES = {
  // Mounjaro monthly subscriptions
  'mounjaro-2.5mg':  'price_1TG7ZzRvWiaT0xusN7LIEuy1',  // £150/month (starter, then £170)
  'mounjaro-5mg':    'price_1TG7ZzRvWiaT0xusC430jCBS',  // £185/month
  'mounjaro-7.5mg':  'price_1TG7a0RvWiaT0xus4VZLc6dw',  // £250/month
  'mounjaro-10mg':   'price_1TG7a1RvWiaT0xusXiFZdB5e',  // £275/month
  'mounjaro-12.5mg': 'price_1TG7a1RvWiaT0xusoIf1IMCK',  // £285/month
  'mounjaro-15mg':   'price_1TG7a2RvWiaT0xusoYCyjDxQ',  // £310/month

  // Wegovy monthly subscriptions
  'wegovy-0.25mg': 'price_1TG7b8RvWiaT0xusq6uqsal4',  // £114/month
  'wegovy-0.5mg':  'price_1TG7aaRvWiaT0xussfxNvUFH',  // £139/month
  'wegovy-1mg':    'price_1TG7abRvWiaT0xus8pjfOgN2',  // £169/month
  'wegovy-1.7mg':  'price_1TG7abRvWiaT0xuszy0IWscg',  // £199/month
  'wegovy-2.4mg':  'price_1TG7acRvWiaT0xusN7Ge7kgx',  // £229/month

  // Health Check Standard
  'hc-standard-initial': 'price_1TG7b9RvWiaT0xus5M81KSKX',  // £599 one-off
  'hc-standard-annual':  'price_1TG7b9RvWiaT0xus1e37XZGC',  // £1,000/year

  // Health Check Premium
  'hc-premium-initial': 'price_1TG7bARvWiaT0xusbRFtVo8Z',  // £999 one-off
  'hc-premium-annual':  'price_1TG7bARvWiaT0xusLu4Vd46V',  // £1,700/year
}

export const treatments = {
  mounjaro: {
    name: 'Mounjaro',
    doses: [
      { id: 'mounjaro-2.5mg',  dose: '2.5mg',  pricePence: 15000, ongoingPricePence: 17000, stripePriceId: STRIPE_PRICES['mounjaro-2.5mg'] },
      { id: 'mounjaro-5mg',    dose: '5mg',    pricePence: 18500, stripePriceId: STRIPE_PRICES['mounjaro-5mg'] },
      { id: 'mounjaro-7.5mg',  dose: '7.5mg',  pricePence: 25000, stripePriceId: STRIPE_PRICES['mounjaro-7.5mg'] },
      { id: 'mounjaro-10mg',   dose: '10mg',   pricePence: 27500, stripePriceId: STRIPE_PRICES['mounjaro-10mg'] },
      { id: 'mounjaro-12.5mg', dose: '12.5mg', pricePence: 28500, stripePriceId: STRIPE_PRICES['mounjaro-12.5mg'] },
      { id: 'mounjaro-15mg',   dose: '15mg',   pricePence: 31000, stripePriceId: STRIPE_PRICES['mounjaro-15mg'] },
    ],
  },
  wegovy: {
    name: 'Wegovy',
    doses: [
      { id: 'wegovy-0.25mg', dose: '0.25mg', pricePence: 11400, stripePriceId: STRIPE_PRICES['wegovy-0.25mg'] },
      { id: 'wegovy-0.5mg',  dose: '0.5mg',  pricePence: 13900, stripePriceId: STRIPE_PRICES['wegovy-0.5mg'] },
      { id: 'wegovy-1mg',    dose: '1mg',    pricePence: 16900, stripePriceId: STRIPE_PRICES['wegovy-1mg'] },
      { id: 'wegovy-1.7mg',  dose: '1.7mg',  pricePence: 19900, stripePriceId: STRIPE_PRICES['wegovy-1.7mg'] },
      { id: 'wegovy-2.4mg',  dose: '2.4mg',  pricePence: 22900, stripePriceId: STRIPE_PRICES['wegovy-2.4mg'] },
    ],
  },
}

export const healthCheckPackages = [
  {
    id: 'hc-standard',
    name: '360',
    pricePence: 59900,
    annualPricePence: 100000,
    stripePriceId: STRIPE_PRICES['hc-standard-initial'],
    stripeAnnualPriceId: STRIPE_PRICES['hc-standard-annual'],
    description: 'Comprehensive health screening with full body ultrasound, 30+ biomarkers, and GP consultation',
    recommended: true,
    includes: [
      'Full body ultrasound',
      '30+ biomarker blood panel',
      'Resting ECG',
      'Blood pressure & body composition',
      'Private GP consultation & report',
    ],
  },
  {
    id: 'hc-premium',
    name: 'Premium',
    pricePence: 99900,
    annualPricePence: 170000,
    stripePriceId: STRIPE_PRICES['hc-premium-initial'],
    stripeAnnualPriceId: STRIPE_PRICES['hc-premium-annual'],
    description: 'Advanced screening with echocardiogram, 50+ biomarkers, cancer markers, and consultant review',
    includes: [
      'Full body ultrasound plus',
      '50+ biomarker panel incl. hormones',
      'Echocardiogram, ECG & Carotid Doppler',
      'Cancer markers & specialist screening',
      'Body composition & lifestyle profiling',
      'Consultant review & personalised report',
    ],
    popular: true,
  },
]

export function formatPrice(pence) {
  return `£${(pence / 100).toFixed(pence % 100 === 0 ? 0 : 2)}`
}

export function getTreatmentInfo(treatmentId) {
  for (const [, treatment] of Object.entries(treatments)) {
    const dose = treatment.doses.find((d) => d.id === treatmentId)
    if (dose) return { treatment: treatment.name, ...dose }
  }
  return null
}

// Get the Stripe price ID for a given treatment/dose lookup key
export function getStripePriceId(lookupKey) {
  return STRIPE_PRICES[lookupKey] || null
}
