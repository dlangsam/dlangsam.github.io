# Devorah Langsam - Portfolio Website

A modern, responsive personal portfolio website showcasing my experience, skills, and personality.

## 🚀 Free Hosting Options

### Option 1: GitHub Pages (Recommended - Easiest!)

1. **Create a new GitHub repository**
   ```bash
   cd /Users/devorahlangsam/Projects/devorah-portfolio
   git init
   git add .
   git commit -m "Initial commit: Personal portfolio website"
   ```

2. **Create a repo on GitHub** (go to github.com/new)
   - Name it whatever you want (e.g., `devorah-portfolio` or `devorahlangsam.github.io`)
   - Make it public
   - Don't initialize with README (you already have files)

3. **Push to GitHub**
   ```bash
   git remote add origin https://github.com/YOUR-USERNAME/REPO-NAME.git
   git branch -M main
   git push -u origin main
   ```

4. **Enable GitHub Pages**
   - Go to your repo Settings → Pages
   - Source: Deploy from branch → `main` → `/ (root)`
   - Click Save
   - Your site will be live at: `https://YOUR-USERNAME.github.io/REPO-NAME/`

**Custom domain?** You can add one in Settings → Pages → Custom domain

---

### Option 2: Netlify (Great for continuous deployment!)

1. **Install Netlify CLI** (or use the web UI)
   ```bash
   npm install -g netlify-cli
   ```

2. **Deploy**
   ```bash
   cd /Users/devorahlangsam/Projects/devorah-portfolio
   netlify deploy
   ```

3. **Follow prompts:**
   - Authorize with GitHub
   - Create a new site
   - Deploy directory: `.` (current directory)
   - For production: `netlify deploy --prod`

**Your site URL:** Netlify gives you a random URL like `random-name-12345.netlify.app`
- You can customize this in Site Settings
- Free SSL included
- Free custom domain support

---

### Option 3: Vercel (Another excellent free option!)

1. **Install Vercel CLI** (or use web UI at vercel.com)
   ```bash
   npm install -g vercel
   ```

2. **Deploy**
   ```bash
   cd /Users/devorahlangsam/Projects/devorah-portfolio
   vercel
   ```

3. **Follow prompts** - super simple!

**Your site URL:** Gets a URL like `devorah-portfolio.vercel.app`
- Free SSL
- Free custom domain support
- Automatic deployments from GitHub

---

### Option 4: Cloudflare Pages

1. **Push to GitHub** (see GitHub Pages instructions above)
2. **Go to** [pages.cloudflare.com](https://pages.cloudflare.com)
3. **Connect your GitHub repo**
4. **Deploy** - it's automatic!

Benefits: Blazing fast global CDN, free SSL, custom domains

---

## 🎨 Customization

### Before Deploying - Update These:

1. **Open Graph tags** in `index.html`:
   - Replace `https://yourdomain.com/` with your actual URL
   - Create an og-image.png (1200x630px) or remove the image meta tags

2. **Analytics** (optional):
   - Uncomment the analytics code in the `<head>` section
   - Add your Google Analytics ID or Plausible domain

### Updating Content

- **Personal info:** Edit `index.html` - search for your name, email, phone
- **Colors:** Edit CSS variables in `styles.css` (lines 8-19)
- **Add projects:** When you have projects to showcase, add a Projects section before Skills

### Color Scheme

Want to change colors? Update these CSS variables in `styles.css`:

```css
:root {
    --primary-color: #6366f1;      /* Main purple */
    --secondary-color: #ec4899;     /* Pink accent */
    --accent-color: #14b8a6;        /* Teal */
}
```

Try these alternatives:
- **Blue & Orange:** `#3b82f6` and `#f59e0b`
- **Green & Purple:** `#10b981` and `#8b5cf6`
- **Teal & Rose:** `#14b8a6` and `#f43f5e`

### Adding Projects (Later)

When ready, add this section before Skills in `index.html`:

```html
<!-- Projects Section -->
<section id="projects" class="projects">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
            <div class="project-card">
                <h3>Project Name</h3>
                <p>Description of what you built...</p>
                <div class="tech-tags">
                    <span class="tag">React</span>
                    <span class="tag">Node.js</span>
                </div>
                <a href="#" class="project-link">View Project →</a>
            </div>
        </div>
    </div>
</section>
```

And add Projects to the navigation menu.

---

## 📱 Features

- ✅ Fully responsive (mobile, tablet, desktop)
- ✅ Smooth scrolling navigation
- ✅ Animated timeline
- ✅ Skill progress bars
- ✅ Fun interactive elements
- ✅ SEO-friendly
- ✅ Fast loading
- ✅ No build process needed!

---

## 🔧 Tech Stack

- HTML5
- CSS3 (with CSS Grid & Flexbox)
- Vanilla JavaScript
- Google Fonts (Inter & Fira Code)

No frameworks, no dependencies, no build tools - just simple, fast code!

---

## 📝 To-Do

- [ ] Deploy to hosting platform
- [ ] Add custom domain (optional)
- [ ] Add projects when ready
- [ ] Consider adding a blog section
- [ ] Add Google Analytics (optional)

---

## 💡 Tips

**Before deploying:**
- Test locally by opening `index.html` in your browser
- Check all links work
- Test on mobile (use browser dev tools)
- Update the GitHub and LinkedIn URLs

**After deploying:**
- Share your new portfolio URL on LinkedIn!
- Add it to your email signature
- Include it in job applications

---

## 🎉 Let me know if you need help!

Questions about deployment or customization? Just ask!
