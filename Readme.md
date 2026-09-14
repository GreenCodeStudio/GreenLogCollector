# Green Log Collector

Green Log Collector is an open-source monitoring tool for apps and websites. It helps you detect failures quickly, track uptime, and collect basic usage statistics.

You can use it in our cloud at https://greenlogcollector.green-code.studio/ or run it on your own server.

## Features

* Uptime monitoring for websites and applications
* Instant notifications when a problem appears
* View statistics for visits and unique users
* Bot filtering to keep analytics cleaner
* Support for multiple users and assigning permissions per user

## Pricing

Cloud hosting on our servers is paid (excluding the free plan with limits), but if you run Green Log Collector on your own server, it is free with no limits.

## License

MIT


## Installation guide

1. Install web server (for example Nginx) with PHP (8.5 or higher)
2. Install MySQL and create empty database
3. Install PowerShell (pwsh) - on Windows it's built-in, but can be in old version, on Linux and MacOS you need to install it.
2. Download ZIP archive from releases page and extract.
3. Configure web server to point to `public_html` directory.
4. Fill .env file
5. Run in powershell script creating tables in MySQL:

```powershell
. ./script;
Upgrade-Migration;
```
