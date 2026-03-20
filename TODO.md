# Business Owner Registration Flow Implementation

## Overview
This document outlines the implementation plan for allowing business owners to register accounts, fill in company information, and post coupons.

## Current System Architecture
- User model: name, email, phone, password
- Store model: name, slug, country, logo
- Coupon model: linked to store and category
- Roles: client, merchant (newly added), admin
- Registration: name, phone, password (currently assigns 'client' role)

## Implementation Plan

### 1. Database Schema Updates
- [ ] Add `user_id` field to `stores` table to link stores to users
- [ ] Create migration to add the field

### 2. Model Updates
- [ ] Update `User` model to add relationship to Store (`hasOne` or `hasMany`)
- [ ] Update `Store` model to add relationship to User (`belongsTo`)
- [ ] Update the registration process to assign 'merchant' role when appropriate

### 3. Registration Enhancement
- [ ] Create a registration option for business owners that assigns 'merchant' role
- [ ] Fix login inconsistency (currently uses email but registration uses phone)

### 4. Company Information Flow
- [ ] Create a form for business owners to enter company information (store details)
- [ ] Route: `/dashboard/store-setup` (or similar)
- [ ] Fields: store name, country, logo, description, etc.

### 5. Store Management
- [ ] Create a Filament resource or form for merchants to manage their store
- [ ] Restrict access so merchants can only manage their own store

### 6. Coupon Posting for Merchants
- [ ] Update the coupon creation form to be accessible by merchants
- [ ] Restrict coupon creation so merchants can only create coupons for their own store
- [ ] Modify the coupon form to auto-populate the merchant's store

### 7. Authorization & Policies
- [ ] Create policies to control access to stores and coupons
- [ ] Ensure merchants can only view/edit their own stores and coupons
- [ ] Update navigation to show appropriate options based on user role

### 8. Dashboard & User Experience
- [ ] Create a dashboard for merchants that shows their store and coupons
- [ ] Add notifications for coupon usage or other relevant metrics
- [ ] Ensure smooth onboarding experience from registration to first coupon

### 9. Testing
- [ ] Write tests for the new registration flow
- [ ] Test role-based access control
- [ ] Test form validation and business logic
- [ ] Test the complete user journey

## Implementation Steps

1. **Model Relationships** (Week 1)
   - Update Store model to belong to User
   - Update User model to have stores
   - Create and run migration

2. **Registration & Role Assignment** (Week 1)
   - Modify registration to assign 'merchant' role when appropriate
   - Fix the login inconsistency

3. **Store Setup Form** (Week 2)
   - Create form for company information input
   - Connect form to store creation

4. **Coupon Management for Merchants** (Week 2-3)
   - Update coupon creation flow
   - Implement authorization

5. **Dashboard & UX** (Week 3)
   - Create merchant dashboard
   - Ensure smooth user experience

## Roles and Permissions
- **Client**: Browse, search, and use coupons
- **Merchant**: Create and manage their own store and coupons
- **Admin**: Full access to manage all stores, coupons, and users

## Future Enhancements
- Allow merchants to have multiple stores (modify relationship from `hasOne` to `hasMany`)
- Add analytics dashboard for merchants to track coupon performance
- Implement approval workflow for new merchant stores
- Add subscription/payment system for premium merchant features