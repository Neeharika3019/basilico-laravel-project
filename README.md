# Homepage Module (Laravel Project)

The homepage is the main interface of the application where users can:

- View restaurant information (About section with slideshow)
- Make a reservation using a popup modal
- Order food items (Add to Cart functionality)
- View customer testimonials (loaded dynamically via API)

## Technologies Used
- Laravel
- jQuery
- AJAX
- JSON API
- MySQL

## Key Features
- AJAX Reservation System
- Add to Cart (AJAX)
- Testimonials API (JSON)
- User Authentication Check
- Dynamic UI using jQuery
  
## Example Flow

### Reservation Flow
1. User visits homepage  
2. Clicks “Reserve”  
3. Reservation modal opens  
4. AJAX request checks availability  
5. If not logged in → redirected to login  
6. If logged in → reservation saved in database  

### Order Online Flow
1. User browses menu items on homepage  
2. Clicks “Add to Cart”  
3. AJAX request adds item to session cart  
4. Success message displayed dynamically  
5. If not logged in → prompted to login before ordering  

