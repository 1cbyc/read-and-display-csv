# Installation & Setup Guide

## Requirements

### Server Requirements
- PHP 7.0 or higher
- Web server (Apache, Nginx, or PHP built-in server)
- File read/write permissions

### Browser Requirements
- Modern web browser with JavaScript enabled
- Supports ES6 JavaScript features

## Quick Start

### Option 1: PHP Built-in Server (Easiest)

1. **Navigate to project directory:**
    ```bash
    cd path/to/read-and-display-csv
    ```

2. **Start PHP server:**
    ```bash
    php -S localhost:8000
    ```

3. **Open in browser:**
    ```
    http://localhost:8000
    ```

### Option 2: Apache/Nginx

1. **Copy files to web server directory:**
    ```bash
    # For Apache (typical location)
    cp -r . /var/www/html/csv-reader/
    
    # For Windows XAMPP
    copy * C:\xampp\htdocs\csv-reader\
    ```

2. **Set proper permissions:**
    ```bash
    chmod 755 index.html read.php
    chmod 644 data.csv
    ```

3. **Access via browser:**
    ```
    http://localhost/csv-reader/
    ```

### Option 3: Windows IIS

1. Create new site in IIS Manager
2. Point to project directory
3. Ensure PHP is configured for IIS
4. Browse to site

## Configuration

### Custom CSV File

To use your own CSV file:

1. Replace `data.csv` with your file, or
2. Edit `config.php` and change `csv_filename` setting:
    ```php
    'csv_filename' => 'your-file.csv',
    ```

### Enable CORS (Cross-Origin Requests)

If accessing from different domain:

1. Edit `config.php`:
    ```php
    'enable_cors' => true,
    'allowed_origins' => ['https://yourdomain.com'],
    ```

2. Or manually edit `read.php` and uncomment CORS headers

### Error Handling

For development/debugging:

Edit `config.php`:
```php
'display_errors' => true,
'log_errors' => true,
```

## Testing

1. **Load the page** - Open `index.html` in browser
2. **Click "Load CSV Data"** - Should display table with data
3. **Test search** - Type in search box to filter rows
4. **Test sorting** - Click column headers to sort
5. **Test export** - Click "Export to CSV" to download

## Troubleshooting

### "CSV file not found" error
- Ensure `data.csv` exists in same directory as `read.php`
- Check file permissions (must be readable by web server)

### "Network response was not ok" error
- Verify PHP is working: create `test.php` with `<?php phpinfo(); ?>`
- Check browser console for detailed error messages
- Ensure `read.php` is accessible

### Data not displaying
- Check CSV file format (proper headers, no encoding issues)
- Open browser DevTools > Network tab to see request/response
- Verify JSON is valid in PHP response

### Table not sorting/filtering
- Check browser console for JavaScript errors
- Ensure JavaScript is enabled
- Clear browser cache and reload

## Sample Data

The project includes two CSV files:

- `data.csv` - Employee sample data
- `sample-products.csv` - Product catalog sample

To switch between them, rename or edit `config.php`.

## Features Overview

### Current Features
- Read CSV files via PHP backend
- Display data in responsive HTML table
- Real-time search/filter across all columns
- Click-to-sort on any column (ascending/descending)
- Export filtered/sorted data to CSV
- Row statistics (columns, rows, cells)
- Mobile-responsive design
- Error handling with user feedback
- Clean, modern UI with gradients

### Future Features
- CSV file upload from browser
- Inline editing of cells
- Add/delete rows
- Multiple file support
- Data validation
- Pagination for large datasets
- Column filtering/hiding
- Charts and visualizations

## Performance Tips

### For Large CSV Files

1. **Enable caching** in `config.php`:
    ```php
    'cache_enabled' => true,
    ```

2. **Set row limit** to prevent memory issues:
    ```php
    'max_rows' => 5000,
    ```

3. Consider implementing pagination (future feature)

## Security Notes

**Important for Production:**

1. **Validate uploaded files** (when upload feature is added)
2. **Sanitize file paths** to prevent directory traversal
3. **Set proper file permissions** (read-only for data files)
4. **Disable error display** in production
5. **Use HTTPS** for sensitive data
6. **Implement rate limiting** for API calls
7. **Validate CSV content** before processing

## Support

- Report bugs: Open an issue on repository
- Feature requests: See CONTRIBUTING.md
- Questions: Check README.md or open discussion

## License

This project is open source under the MIT License. See LICENSE file.

---

**Enjoy using CSV Reader & Display!**

