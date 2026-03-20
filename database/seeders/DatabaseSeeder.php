<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Feedback;
use App\Models\Store;
use App\Models\User;
use App\Models\CouponUsage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Create roles and permissions
        $clientRole = Role::firstOrCreate(['name' => 'client']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $permission = Permission::firstOrCreate(['name' => 'delete articles']);
        $adminRole->givePermissionTo($permission);

        // firstOrCreate admin user
                // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@couponly.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Categories

        Category::updateOrCreate(
            ['slug' => 'food'],
            ['name' => 'Food', 'icon' => 'assets/images/icon/categories-style-icon-55.png']
        );
        Category::updateOrCreate(
            ['slug' => 'clothing'],
            ['name' => 'Clothing', 'icon' => 'assets/images/icon/categories-style-icon-35.png']
        );
        Category::updateOrCreate(
            ['slug' => 'beauty'],
            ['name' => 'Beauty', 'icon' => 'assets/images/icon/categories-style-icon-30.png']
        );
        Category::updateOrCreate(
            ['slug' => 'tech-gadgets'],
            ['name' => 'Tech & Gadgets', 'icon' => 'assets/images/icon/categories-style-icon-47.png']
        );
        Category::updateOrCreate(
            ['slug' => 'electronics'],
            ['name' => 'Electronics', 'icon' => 'assets/images/icon/categories-style-icon-40.png']
        );
        Category::updateOrCreate(
            ['slug' => 'travel'],
            ['name' => 'Travel', 'icon' => 'assets/images/icon/categories-style-icon-46.png']
        );
        Category::updateOrCreate(
            ['slug' => 'medical'],
            ['name' => 'Medical', 'icon' => 'assets/images/icon/categories-style-icon-36.png']
        );
        Category::updateOrCreate(
            ['slug' => 'hotels'],
            ['name' => 'Hotels', 'icon' => 'assets/images/icon/categories-style-icon-34.png']
        );
        Category::updateOrCreate(
            ['slug' => 'fashion'],
            ['name' => 'Fashion', 'icon' => 'assets/images/icon/categories-style-icon-35.png']
        );

        // Stores
     
        Store::updateOrCreate(
            ['slug' => 'canon'],
            ['name' => 'Canon', 'country' => 'Germany', 'logo' => 'assets/images/top-stores-icon-14.png']
        );
        Store::updateOrCreate(
            ['slug' => 'fedex'],
            ['name' => 'FedEx', 'country' => 'Argentina', 'logo' => 'assets/images/top-stores-icon-13.png']
        );
        Store::updateOrCreate(
            ['slug' => 'philips'],
            ['name' => 'Philips', 'country' => 'Egypt', 'logo' => 'assets/images/top-stores-icon-15.png']
        );
        Store::updateOrCreate(
            ['slug' => 'siemens'],
            ['name' => 'Siemens', 'country' => 'UAE', 'logo' => 'assets/images/top-stores-icon-16.png']
        );
        Store::updateOrCreate(
            ['slug' => 'linkedin'],
            ['name' => 'LinkedIn', 'country' => 'Spain', 'logo' => 'assets/images/top-stores-icon-17.png']
        );
        Store::updateOrCreate(
            ['slug' => 'ad-hua'],
            ['name' => 'AD Hua', 'country' => 'Brazil', 'logo' => 'assets/images/top-stores-icon-18.png']
        );
        Store::updateOrCreate(
            ['slug' => 'amazon'],
            ['name' => 'Amazon', 'country' => 'Japan', 'logo' => 'assets/images/top-stores-icon-1.png']
        );
        Store::updateOrCreate(
            ['slug' => 'alibaba'],
            ['name' => 'Alibaba', 'country' => 'Taiwan', 'logo' => 'assets/images/top-stores-icon-7.png']
        );
        Store::updateOrCreate(
            ['slug' => 'alhua'],
            ['name' => 'AlHua', 'country' => 'China', 'logo' => 'assets/images/top-stores-icon-2.png']
        );
        Store::updateOrCreate(
            ['slug' => 'electrolux'],
            ['name' => 'Electrolux', 'country' => 'Sweden', 'logo' => 'assets/images/top-stores-icon-3.png']
        );
        Store::updateOrCreate(
            ['slug' => 'microsoft'],
            ['name' => 'Microsoft', 'country' => 'USA', 'logo' => 'assets/images/top-stores-icon-8.png']
        );
        Store::updateOrCreate(
            ['slug' => 'meta'],
            ['name' => 'Meta', 'country' => 'USA', 'logo' => 'assets/images/top-stores-icon-11.png']
        );
        Store::updateOrCreate(
            ['slug' => 'hp'],
            ['name' => 'HP', 'country' => 'USA', 'logo' => 'assets/images/top-stores-icon-12.png']
        );
        Store::updateOrCreate(
            ['slug' => 'dell'],
            ['name' => 'Dell', 'country' => 'USA', 'logo' => 'assets/images/top-stores-icon-21.png']
        );

        // Coupons
        Coupon::updateOrCreate(
            ['code' => 'SAVE20'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'food')->first()->id,
                'type' => 'Percentage',
                'title' => 'Exclusive 20% Discount',
                'description' => 'Get 20% off your entire purchase.',
                'expire_date' => '2025-12-31',
                'is_exclusive' => true,
                'exclusive_amount' => 100,
                'image' => 'assets/images/index-5-banner-1.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'SAVE15'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Percentage',
                'title' => 'Limited Time: 15% Off',
                'description' => 'Save 15% on electronics.',
                'expire_date' => '2025-11-30',
                'is_exclusive' => true,
                'exclusive_amount' => 50,
                'image' => 'assets/images/index-5-banner-2.png',
                'tags' => 'allOffer bestOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'HALFOFF'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'clothing')->first()->id,
                'type' => 'Percentage',
                'title' => '50% Off for Customers',
                'description' => 'Half price on select fashion items.',
                'expire_date' => '2025-10-31',
                'is_exclusive' => true,
                'exclusive_amount' => 200,
                'image' => 'assets/images/index-5-banner-3.png',
                'tags' => 'allOffer currentlyOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'HUAWEI30'],
            [
                'store_id' => Store::where('slug', 'alhua')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Percentage',
                'title' => 'Get 30% Off Today!',
                'description' => 'Save 30% on Huawei products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-1.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'ADOBE10'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Fixed Amount',
                'title' => 'Save $10 Your Order',
                'description' => 'Get $10 off your Adobe subscription.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-2.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'DELL10'],
            [
                'store_id' => Store::where('slug', 'dell')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Percentage',
                'title' => '10% Off at Checkout',
                'description' => 'Save 10% on Dell products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-3.png',
                'tags' => 'bestOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'META15'],
            [
                'store_id' => Store::where('slug', 'meta')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Percentage',
                'title' => 'Limited: 15% Off',
                'description' => 'Get 15% off Meta products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-4.png',
                'tags' => 'bestOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'APPLE35'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Percentage',
                'title' => 'Holiday: 35% Off',
                'description' => 'Save 35% on Apple products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-5.png',
                'tags' => 'upcomingOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'MICROSOFT40'],
            [
                'store_id' => Store::where('slug', 'microsoft')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Percentage',
                'title' => 'Flash Sale: 40% Off',
                'description' => 'Get 40% off Microsoft products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-6.png',
                'tags' => 'upcomingOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'LINKEDIN15'],
            [
                'store_id' => Store::where('slug', 'linkedin')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Percentage',
                'title' => 'Save 15% Instantly',
                'description' => 'Save 15% on LinkedIn subscriptions.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-7.png',
                'tags' => 'currentlyOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'HP10'],
            [
                'store_id' => Store::where('slug', 'hp')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Percentage',
                'title' => '10% Off All Products',
                'description' => 'Save 10% on HP products.',
                'expire_date' => '2025-10-25',
                'is_exclusive' => false,
                'image' => 'assets/images/collection-img-8.png',
                'tags' => 'currentlyOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'FEDEX15'],
            [
                'store_id' => Store::where('slug', 'fedex')->first()->id,
                'category_id' => Category::where('slug', 'travel')->first()->id,
                'type' => 'Percentage',
                'title' => '15% Off First Purchase',
                'description' => 'Save 15% on your first online purchase today.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-7.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'PHILIPS25'],
            [
                'store_id' => Store::where('slug', 'philips')->first()?->id,
                'category_id' => Category::where('slug', 'medical')->first()?->id,
                'type' => 'Percentage',
                'title' => '25% Off Home Furnishings',
                'description' => '25% off all home furnishings - shop now.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-8.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'SIEMENS30'],
            [
                'store_id' => Store::where('slug', 'siemens')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Fixed Amount',
                'title' => '$30 Off Orders Over $150',
                'description' => '$30 off orders over $150 - use code.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-9.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'LINKEDIN20'],
            [
                'store_id' => Store::where('slug', 'linkedin')->first()->id,
                'category_id' => Category::where('slug', 'tech-gadgets')->first()->id,
                'type' => 'Percentage',
                'title' => '20% Off Electronics',
                'description' => '20% off all electronics - limited time offer.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => null,
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'SIEMENS30'],
            [
                'store_id' => Store::where('slug', 'siemens')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Fixed Amount',
                'title' => '$30 Off Orders Over $150',
                'description' => '$30 off orders over $150 - use code.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-9.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'LINKEDIN20'],
            [
                'store_id' => Store::where('slug', 'linkedin')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Percentage',
                'title' => '20% Off Electronics',
                'description' => '20% off all electronics - limited time offer.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => null,
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'ADHUA10'],
            [
                'store_id' => Store::where('slug', 'ad-hua')->first()?->id,
                'category_id' => Category::where('slug', 'fashion')->first()?->id,
                'type' => 'Percentage',
                'title' => '10% Off All Summer Apparel - Limited Time',
                'description' => '10% off all summer apparel - limited time.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-7.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'AMAZONFS'],
            [
                'store_id' => Store::where('slug', 'amazon')->first()->id,
                'category_id' => Category::where('slug', 'electronics')->first()->id,
                'type' => 'Free Shipping',
                'title' => 'Free Shipping on Orders Over $50 - Shop Today',
                'description' => 'Free shipping on orders over $50 - shop today.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-8.png',
                'tags' => 'allOffer',
            ]
        );
        Coupon::updateOrCreate(
            ['code' => 'ALIBABA30'],
            [
                'store_id' => Store::where('slug', 'alibaba')->first()->id,
                'category_id' => Category::where('slug', 'clothing')->first()->id,
                'type' => 'Percentage',
                'title' => '30% Off All Beauty Products - Limited Stock',
                'description' => '30% off all beauty products - limited stock.',
                'expire_date' => '2025-11-25',
                'is_exclusive' => false,
                'image' => 'assets/images/popular-coupons-9.png',
                'tags' => 'allOffer',
            ]
        );

        // Feedback
        Feedback::updateOrCreate(
            ['name' => 'Kane Williamson'],
            [
                'title' => 'Medical Assistant',
                'comment' => 'There are many variations of passages of Lorem Ipsum available',
                'rating' => 5,
                'image' => 'assets/images/user-img-1.png',
            ]
        );
        Feedback::updateOrCreate(
            ['name' => 'Kathryn Murphy'],
            [
                'title' => 'President of Sales',
                'comment' => 'There are many variations of passages of Lorem Ipsum available',
                'rating' => 5,
                'image' => 'assets/images/user-img-2.png',
            ]
        );
        Feedback::updateOrCreate(
            ['name' => 'Kende Attila'],
            [
                'title' => 'Medical Assistant',
                'comment' => 'There are many variations of passages of Lorem Ipsum available',
                'rating' => 5,
                'image' => 'assets/images/user-img-3.png',
            ]
        );
    
    }
}