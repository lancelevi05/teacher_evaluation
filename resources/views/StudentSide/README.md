# Student Dashboard Template

A clean, reusable dashboard layout template for students. This template is built with responsive design and modern UI components.

## Files

- **dashboard-layout.blade.php** - Main layout template (base)
- **student-dashboard.blade.php** - Example student dashboard implementation
- **home.blade.php** - (Existing file)
- **dashboard.blade.php** - (Existing file)

## Features

✅ Responsive design (mobile, tablet, desktop)  
✅ Sidebar navigation  
✅ Top bar with user avatar  
✅ Welcome card  
✅ Statistics cards grid  
✅ Recent activity section  
✅ Expandable details panel  
✅ Mobile-friendly menu toggle  

## How to Use the Layout

### Extend the layout in your Blade view:

```blade
@extends('StudentSide.dashboard-layout')

@section('title', 'Page Title')
@section('sidebar_title', 'Portal Name')
@section('page_title', 'Page Heading')
@section('user_initials', 'SA')
@section('footer_text', '© Your Footer Text')

@section('nav_items')
    <!-- Add your navigation items here -->
    <span class="nav-label">Menu</span>
    <a class="nav-item active" href="#">Overview</a>
@endsection

@section('content')
    <!-- Your page content here -->
@endsection
```

## Available Sections

| Section | Purpose |
|---------|---------|
| `title` | Browser tab title |
| `sidebar_title` | Sidebar header text |
| `page_title` | Top bar heading |
| `user_initials` | User avatar text |
| `footer_text` | Footer content |
| `nav_items` | Navigation menu items |
| `content` | Main page content |

## CSS Classes

### Navigation
- `.nav-item` - Navigation link
- `.nav-item.active` - Active navigation state
- `.nav-label` - Section label

### Cards
- `.stat-card` - Statistics card container
- `.stat-label` - Card label text
- `.stat-value` - Main value display
- `.stat-change` - Change indicator

### Activity
- `.activity-item` - Activity list item
- `.activity-dot` - Activity indicator dot

### Buttons
- `.expand-button` - Expandable section toggle
- `.expand-panel` - Hidden panel content

## Responsive Breakpoints

- **768px and below** - Tablet layout (sidebar becomes overlay)
- **480px and below** - Mobile layout (adjusted typography and spacing)

## Example

See `student-dashboard.blade.php` for a complete working example.

## Customization

Edit the CSS variables in `dashboard-layout.blade.php`:
- Colors: `#1e3a5f`, `#2c6fba`, etc.
- Font: 'DM Sans' (can be changed)
- Spacing and sizing values

## Notes

- The template uses Tailwind CSS and Lucide icons
- All icons use inline SVG for better control
- Mobile menu toggles sidebar on smaller screens
- Expand panel has smooth animations
