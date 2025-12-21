# CSV Reader & Display - Quick Reference

## File Structure
```
read-and-display-csv/
├── index.html              # Main frontend interface
├── read.php                # Backend API for reading CSV
├── data.csv                # Primary CSV data file
├── config.php              # Configuration settings
├── sample-products.csv     # Alternative sample data
├── README.md               # Project documentation
├── INSTALL.md              # Installation guide
├── CONTRIBUTING.md         # Contribution guidelines
├── LICENSE                 # MIT License
├── .gitignore              # Git ignore rules
└── QUICK-REFERENCE.md      # This file
```

## Key Functions (JavaScript)

| Function | Purpose |
|----------|---------|
| `loadData()` | Fetches CSV data from PHP backend via AJAX |
| `displayData(data)` | Renders data as HTML table |
| `sortTable(columnIndex)` | Sorts table by clicked column |
| `filterTable()` | Filters rows based on search input |
| `exportToCSV()` | Downloads current data as CSV file |
| `updateSortIndicators(col)` | Updates visual sort indicators |

## Key Files & Their Roles

### index.html
- **Purpose:** Frontend user interface
- **Key Features:** 
  - Responsive table display
  - Search bar for filtering
  - Sortable column headers
  - Export button
  - Statistics display
- **Dependencies:** None (vanilla JS)

### read.php
- **Purpose:** Backend API endpoint
- **Input:** None (reads from data.csv)
- **Output:** JSON array of CSV data
- **Error Handling:** Returns JSON error with 500 status code

### config.php
- **Purpose:** Centralized configuration
- **Customizable Settings:**
  - CSV filename and delimiters
  - CORS settings
  - Error handling options
  - Performance limits
  - Feature flags

## User Actions

| Action | How To | Result |
|--------|--------|--------|
| Load Data | Click "Load CSV Data" button | Fetches and displays CSV contents |
| Search | Type in search box | Filters visible rows in real-time |
| Sort | Click any column header | Sorts data ascending/descending |
| Export | Click "Export to CSV" | Downloads filtered/sorted data |
| Refresh | Click "Refresh Page" | Reloads entire page |

## CSS Classes

### Main Containers
- `.container` - Main wrapper
- `.table-container` - Table scroll wrapper
- `.controls` - Top control bar
- `.stats` - Bottom statistics bar

### State Classes
- `.loading` - Loading message style
- `.error` - Error message style
- `.sortable` - Sortable header indicator
- `.sort-asc` - Ascending sort indicator
- `.sort-desc` - Descending sort indicator

### Interactive Elements
- `button` - Standard button style
- `button.secondary` - Secondary button (gray)
- `button.success` - Success button (green)
- `button:disabled` - Disabled state

## Global Variables (JavaScript)

| Variable | Type | Purpose |
|----------|------|---------|
| `globalData` | Array | Stores complete CSV data for sorting/filtering |
| `currentSortColumn` | Number | Tracks currently sorted column index |
| `currentSortOrder` | String | 'asc' or 'desc' sort direction |

## PHP Response Format

### Success Response
```json
[
  ["Header1", "Header2", "Header3"],
  ["Row1Col1", "Row1Col2", "Row1Col3"],
  ["Row2Col1", "Row2Col2", "Row2Col3"]
]
```

### Error Response
```json
{
  "error": true,
  "message": "Error description here"
}
```

## Browser Compatibility

| Feature | Requirement |
|---------|-------------|
| Fetch API | Chrome 42+, Firefox 39+, Safari 10.1+, Edge 14+ |
| Arrow Functions | Chrome 45+, Firefox 22+, Safari 10+, Edge 12+ |
| const/let | Chrome 49+, Firefox 36+, Safari 10+, Edge 12+ |
| Template Literals | Chrome 41+, Firefox 34+, Safari 9+, Edge 12+ |

## Common Customizations

### Change Color Scheme
Edit the gradient in `index.html`:
```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

### Change CSV File
Edit `config.php`:
```php
'csv_filename' => 'your-file.csv',
```

### Adjust Table Appearance
Modify CSS in `<style>` section of `index.html`

### Add Custom Statistics
Edit the stats section in `displayData()` function

## Performance Metrics

| Dataset Size | Load Time* | Memory Usage* |
|--------------|-----------|---------------|
| 100 rows | <100ms | ~50KB |
| 1,000 rows | <500ms | ~500KB |
| 10,000 rows | <2s | ~5MB |
| 50,000+ rows | Consider pagination | >25MB |

*Approximate values, varies by hardware and browser

## Security Checklist

- [ ] Validate all file inputs
- [ ] Sanitize CSV content before display
- [ ] Use HTTPS in production
- [ ] Disable error display in production
- [ ] Set appropriate file permissions
- [ ] Implement CORS properly if needed
- [ ] Add rate limiting for API
- [ ] Validate CSV file size limits

## Testing Checklist

- [ ] Load CSV successfully
- [ ] Display all rows and columns
- [ ] Search filters correctly
- [ ] Sorting works on all columns
- [ ] Numeric columns sort numerically
- [ ] Text columns sort alphabetically
- [ ] Export produces valid CSV
- [ ] Mobile responsive design works
- [ ] Error handling displays properly
- [ ] Empty CSV handled gracefully

## Keyboard Shortcuts

Currently none implemented. Potential additions:
- Ctrl+F - Focus search box
- Ctrl+S - Export CSV
- Ctrl+R - Reload data
- Esc - Clear search

## Browser DevTools Tips

### Check API Response
1. Open DevTools (F12)
2. Go to Network tab
3. Click "Load CSV Data"
4. Click on "read.php" request
5. View Response tab

### Debug JavaScript
1. Open Console tab (F12)
2. Check for error messages
3. Use `console.log(globalData)` to inspect data

### Inspect Elements
1. Right-click any element
2. Select "Inspect"
3. View/edit styles in real-time

## Git Commands

```bash
# Clone repository
git clone <repository-url>

# Check status
git status

# Add changes
git add .

# Commit changes
git commit -m "Description"

# Push to remote
git push origin main
```

## Useful Links

- PHP fgetcsv(): https://www.php.net/manual/en/function.fgetcsv.php
- Fetch API: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API
- CSV Format: https://tools.ietf.org/html/rfc4180

---

**Need more help?** Check INSTALL.md for setup instructions or README.md for full documentation.
