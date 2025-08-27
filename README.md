# 📌 Events Custom Plugin  

A custom WordPress plugin to manage **Events** with custom fields, an admin settings page, and a shortcode to display events on the frontend.  

---

## ✨ Features
- Custom Post Type **Event** (title, description, featured image).  
- Event details stored as custom fields:  
  - Event Date  
  - Event Location  
  - Event Organizer  
- **Admin Settings Page** to set a **Default Location**.  
- **Shortcode `[events_list]`** → Display all upcoming events on any page/post.  
- Automatically applies default location if no location is entered.  
- Clean frontend display with event title, image, date, location, organizer, and description.  

---

## 📂 Project Structure

events-custom-plugin/
│
├── includes/
│ ├── class-events-cpt.php # Registers Event Custom Post Type
│ ├── class-events-settings.php # Admin Settings Page
│ ├── class-events-shortcode.php # Shortcode for displaying events
│ ├── class-events-defaults.php # Applies default location automatically│
├── events-custom-plugin.php # Main plugin file (entry point)
├── README.md # Documentation



---

## ⚙️ Installation

1. Download or clone this repository.  
2. Upload the folder **`events-custom-plugin`** into your WordPress:  
3. Go to **WordPress Admin → Plugins**, find **Events Custom Plugin**, and click **Activate**.  
4. The plugin will add:  
- A new **Events** post type in the sidebar.  
- A new **Events Settings** menu item.  

---

## 🖥️ Usage

### 1. Add Events
- Go to **Events → Add New**.  
- Enter:
- **Title** (Event name)  
- **Description** (Event details)  
- **Event Date**  
- **Event Location** (auto-filled with default if empty)  
- **Event Organizer**  
- Add a **Featured Image** if needed.  
- Click **Publish**.  

---

### 2. Configure Settings
- Go to **Events Settings** in the admin menu.  
- Enter a **Default Location**.  
- This value will be automatically applied to any event that does not have a location.  

---

### 3. Display Events on Frontend
Add the shortcode to any post or page:  

```php
[events_list]
