---
layout: post
title: "From Heroku to Render: Deploying Rails for Free in 2026"
date: 2026-05-14
author: Devorah Langsam
tags: [Rails, Deployment, Tutorial, PostgreSQL]
excerpt: "A comeback story: How I resurrected my Rails dreams after Heroku killed the free tier, and found a truly free deployment solution in 2026."
---

**A Comeback Story**
*Or: How I resurrected my Rails dreams after Heroku killed the free tier*

---

## The Backstory

Back in the summer of 2016, I took a bootcamp in Miami focused on Ruby on Rails. I'd studied Computer Science in college, but my jump from Math in undergrad to CS in grad school had skipped a lot of the web development focused classes in favor of advanced theory. When I left the world of flight simulation, this bootcamp gave me the fundamentals and named a lot of the things I'd already self-taught along the way. I loved getting to see things I wrote in code so quickly breathe life with Rails.

My final bootcamp project was **BorrowABash** — a site where people could share party supplies with neighbors. Got an inflatable bouncy castle? List it! Need folding chairs for 50? Borrow them! I got so into practicing Rails that I even revived my husband's old class project, a website about war movies he was super proud of. Seeing his face light up when I showed him it was live again made all those hours of debugging worth it.

Then in 2022, Heroku removed their free tier. I watched BorrowABash sunset along with thousands of other hobby projects. It stung more than I expected.

## A Detour

In 2024, I got the itch to play around with AI tools and rewrite code in different frontend frameworks. The war movies site was the perfect candidate — it never actually needed a backend, so I rewrote it as a pure static frontend and deployed it to Netlify. Easy, free, done.

But Rails? Rails stayed dormant.

## Two Years Later

Fast forward to 2026. I wanted to build something with Rails 8, see what's new. So I started a new Rails project and coded locally for a month — Vue 3 frontend, JWT auth, the whole nine yards. What made it feel different this time was how fast I could build. With Claude Code, features that would've taken me days were coming together in hours.

But here's the thing about localhost: it's lonely.

I refused to pay to deploy it. Call it stubbornness or principle, but after experiencing Heroku's free tier, paying for a hobby project felt wrong. So I went on a quest to find truly free hosting in 2026.

## The Options (And Why I Didn't Choose Them)

**Fly.io** — used to have a free tier, gone the way of Heroku. No clear free option, unclear pricing. Pass.

**Railway** — $5 free credits monthly, but requires a credit card on file. If you misconfigure something and blow past $5, you get charged. I wanted zero financial footprint. Pass (though I might try it next time).

**Vercel/Netlify** — great for frontends, but no PostgreSQL. I'd still need to host my Rails API elsewhere. Pass.

### Render

Render checked all the right boxes:
- No credit card required for free tier
- Supports Docker
- Can host both frontend and backend
- Services sleep after 15 minutes of inactivity
- First request after sleep takes ~30 seconds

The sleep thing isn't ideal, but for a hobby project I can live with it. **One caveat:** the free tier doesn't support background workers, so if your app needs those, you'll need to upgrade.

For the database, Render's free PostgreSQL expires after 30 days — meaning you'd have to backup, delete, recreate, and restore every month. Hard pass. **Supabase** offers free PostgreSQL that doesn't expire: 500MB, permanently free, no credit card.

## Winner: Render + Supabase

## What Actually Happened When I Deployed

What could go wrong?

**A lot.**

While Claude assured me this was 10-15 minutes of work, I quickly found myself late into the night fighting config errors like whack-a-mole. Eventually I did the only reasonable thing: I went to sleep.

In the morning, I reminded Claude that a night had indeed passed and it was time to start again. The final few errors dissolved surprisingly quickly. Even with AI, rest is important.

Here's what broke (and how I fixed it):

### Issue #1: Rails Ignored My DATABASE_URL

I set `DATABASE_URL` in Render's environment variables. Rails completely ignored it and tried to connect to localhost.

**The reason:** Rails 8's `config/database.yml` uses a new multi-database setup for Solid Cache and friends. It expects individual env vars like `DB_HOST`, `DB_USERNAME`, and `DB_PASSWORD` — when those aren't set, it defaults to localhost. The fix is to explicitly point each database to `DATABASE_URL`:

```yaml
production:
  primary:
    url: <%= ENV['DATABASE_URL'] %>
  cache:
    url: <%= ENV['DATABASE_URL'] %>
    migrations_paths: db/cache_migrate
  # ... etc
```

### Issue #2: The IPv6 Problem (The Big One)

My backend deployed! Logs looked good! But it couldn't connect to Supabase:

```
connection to server at "2600:1f18:...", port 5432 failed: Network is unreachable
```

Render's free tier doesn't support IPv6. Supabase's default "direct connection" uses IPv6. **The solution** is Supabase's Session Pooler, which provides an IPv4 connection.

Finding where to actually make this change in Supabase's UI was the real adventure — I eventually caved and asked Supabase's AI tool, which actually knew where to look. Head to the connection string section and look for the note that says "Not IPv4 compatible - Use Session Pooler". Switch modes and you'll get a connection string that looks like this:

```
postgresql://postgres.PROJECT:PASSWORD@aws-0-region.pooler.supabase.com:5432/postgres
```

Two things to notice:
- Hostname ends in `.pooler.supabase.com` (not `db.*.supabase.co`)
- Username is `postgres.YOUR_PROJECT_ID` (not just `postgres`)

After switching, everything connected perfectly.

### Issue #3: Configuration Whack-a-Mole

Wrong CORS origins, mistyped API URLs, passwords with special characters breaking URL parsing, env vars that weren't being read. The debugging loop: deploy, check logs, fix one thing, redeploy, discover new error, repeat.

**One tip that saved me time:** check both frontend and backend logs. Half my issues were CORS-related but showed up differently on each side. A little sleep might have solved some of it.

## The Final Setup

After a day (and a night, and another morning) of debugging, here's what worked:

**Backend (Render Web Service)**
- Docker-based Rails 8 API
- Connected to Supabase via Session Pooler
- Free tier (sleeps after 15min)

**Frontend (Render Static Site)**
- Vue 3 + Vite build
- Deployed as static files
- Free tier (no sleeping!)

**Database (Supabase)**
- PostgreSQL 500MB
- Free forever, no expiration
- Session Pooler for IPv4 connectivity

**Total cost: $0/month**

## The Verdict

**Render + Supabase is the closest thing to Heroku's free tier in 2026** — actually free ($0, no credit card), no data expiration, and good enough for hobby projects. The setup is more involved than Heroku was, but once it's working, deploys are smooth. Just push to GitHub and both services auto-update; you can even configure it to wait for CI checks to pass first.

Would I use this for a startup? Probably not — the 30-second cold start would hurt user experience. For personal projects, learning, and keeping old dreams alive? Absolutely. BorrowABash might still be gone, but at least I know I can build and deploy the next idea without opening my wallet.

---

**The key takeaway:** if you're deploying Rails + Supabase on Render and getting connection errors, use Supabase's Session Pooler connection string, not the direct connection. That's the secret that took me an evening to figure out.

---

*Want the full technical details? Hit me up and I'll share the GitHub repo.*
