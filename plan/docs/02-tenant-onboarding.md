# Module 02: Tenant Onboarding & Subscription

**Status:** ❌ Not Started  
**Business Value:** New customers can sign up and start in under 2 minutes

## Features
- Public landing page → instant sign-up → payment → auto subdomain
- 14-day free trial
- bKash, Nagad, Card, Bank Transfer
- Auto invoice & receipt generation

## Database Tables Required
- `subscriptions`
- `subscription_plans`
- `invoices`
- `payments` (tenant-level)

## Relationships
- Tenant → Subscription (one-to-one)
- Subscription → SubscriptionPlan (belongs-to)
- Tenant → Invoices (one-to-many)
- Invoice → Payments (one-to-many)