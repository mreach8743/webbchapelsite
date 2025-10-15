# Deployment Guide

## Build Process

The React application is built using Vite and can be deployed to any static hosting service.

### Build Commands

```bash
# Development build
npm run build

# Production build with optimizations
npm run build:production

# Preview the built application
npm run preview

# Serve the built application
npm run serve
```

### Build Output

The build process creates a `dist/` directory containing:
- Static HTML, CSS, and JavaScript files
- Optimized assets
- All necessary files for deployment

## Deployment Options

### 1. Static Hosting Services

#### Netlify
1. Connect your repository to Netlify
2. Set build command: `npm run build:production`
3. Set publish directory: `dist`
4. Deploy automatically on git push

#### Vercel
1. Connect your repository to Vercel
2. Set build command: `npm run build:production`
3. Set output directory: `dist`
4. Deploy automatically on git push

#### GitHub Pages
1. Enable GitHub Pages in repository settings
2. Use GitHub Actions to build and deploy
3. Set source to GitHub Actions

### 2. Traditional Web Hosting

#### Apache/Nginx
1. Build the application: `npm run build:production`
2. Upload the contents of `dist/` to your web server
3. Configure server to serve `index.html` for all routes (SPA routing)

#### Example Apache .htaccess:
```apache
RewriteEngine On
RewriteBase /
RewriteRule ^index\.html$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.html [L]
```

### 3. CDN Deployment

#### AWS S3 + CloudFront
1. Build the application: `npm run build:production`
2. Upload `dist/` contents to S3 bucket
3. Configure CloudFront distribution
4. Set up custom domain and SSL

## Environment Configuration

### Production Environment Variables

Create a `.env.production` file for production-specific settings:

```env
VITE_APP_TITLE=Webb Chapel Church of Christ
VITE_APP_URL=https://your-domain.com
VITE_GOOGLE_MAPS_API_KEY=your_google_maps_api_key
VITE_COGNITO_FORM_KEY=V3ZbR_hZIEKuz9M3qRqiEA
```

### Development Environment Variables

Create a `.env.local` file for local development:

```env
VITE_APP_TITLE=Webb Chapel Church of Christ (Development)
VITE_APP_URL=http://localhost:5173
```

## Third-Party Integrations

### Required External Services

1. **Google Maps API**
   - Enable Google Maps Embed API
   - No API key required for basic embedding

2. **Cognito Forms**
   - Forms are embedded using their seamless.js script
   - No additional configuration needed

3. **Christian World Media**
   - Live streaming and sermon archives
   - Embedded via iframe, no API key required

4. **Mailchimp**
   - Email subscription service
   - Configure in MailchimpForm component

## Performance Optimization

### Build Optimizations

- Code splitting with React.lazy()
- Tree shaking for unused code
- Asset optimization and compression
- CSS purging with Tailwind CSS

### Runtime Optimizations

- Lazy loading of images
- Memoization of expensive components
- Efficient state management
- Optimized bundle size

## Monitoring and Analytics

### Recommended Tools

1. **Google Analytics** - Add tracking code to index.html
2. **Google Search Console** - Submit sitemap
3. **PageSpeed Insights** - Monitor performance
4. **Uptime monitoring** - Set up alerts

## Security Considerations

### Content Security Policy

Add CSP headers to prevent XSS attacks:

```html
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https://www.cognitoforms.com https://www.christianworldmedia.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https://webbchapel.us19.list-manage.com;">
```

### HTTPS

- Always use HTTPS in production
- Configure SSL certificates
- Redirect HTTP to HTTPS

## Maintenance

### Regular Updates

1. **Dependencies**: Update npm packages regularly
2. **Security**: Monitor for security vulnerabilities
3. **Performance**: Monitor Core Web Vitals
4. **Content**: Update church information as needed

### Backup Strategy

1. **Code**: Git repository with remote backup
2. **Content**: Regular backups of any CMS content
3. **Database**: If using a database, regular backups
4. **Files**: Backup of uploaded files and assets

## Troubleshooting

### Common Issues

1. **Routing Issues**: Ensure server is configured for SPA routing
2. **Build Failures**: Check TypeScript errors and dependencies
3. **Third-party Scripts**: Verify external script loading
4. **Performance**: Monitor bundle size and loading times

### Debug Mode

Enable debug mode in development:

```bash
npm run dev -- --debug
```

## Support

For technical support or questions about the deployment process, contact the development team or refer to the project documentation.
