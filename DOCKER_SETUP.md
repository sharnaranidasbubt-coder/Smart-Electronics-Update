# Smart Electronics - Docker Setup Guide

Complete Docker Compose setup for the Smart Electronics WordPress project.

## 📋 Prerequisites

Ensure you have the following installed:
- Docker (v20.10 or higher)
- Docker Compose (v2.0 or higher)

### Install Docker on Ubuntu/Debian/Kali:

```bash
# Update packages
sudo apt update

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Add your user to docker group (to run docker without sudo)
sudo usermod -aG docker $USER

# Apply group changes (log out and back in, or run)
newgrp docker

# Verify installation
docker --version
docker compose version
```

---

## 🚀 Quick Start

### 1. Navigate to the project directory:

```bash
cd /home/sharna/Documents/Smart-Electronics-Update
```

### 2. Start the containers:

```bash
docker compose up -d
```

### 3. Check running containers:

```bash
docker compose ps
```

### 4. Access your site:

- **WordPress Site**: [http://localhost:8080](http://localhost:8080)
- **phpMyAdmin**: [http://localhost:8081](http://localhost:8081)
  - Username: `root`
  - Password: `root`

---

## 📦 Project Structure

```
Smart-Electronics-Update/
├── docker-compose.yml          # Main Docker Compose configuration
├── app/
│   ├── public/                 # WordPress files (mounted to /var/www/html)
│   └── sql/                    # SQL dump files (auto-imported on first run)
├── conf/
│   ├── nginx/                  # Nginx configuration files
│   └── php/                    # PHP configuration files
├── logs/
│   └── nginx/                  # Nginx logs
└── .dockerignore              # Files excluded from Docker context
```

---

## 🔧 Services

### WordPress (PHP-FPM + Nginx)
- **Image**: `wordpress:6.7-php8.2-fpm`
- **Port**: 8080
- **Volume**: `./app/public:/var/www/html`

### MySQL 8.0
- **Image**: `mysql:8.0`
- **Port**: 3306 (internal only)
- **Database**: `local`
- **User**: `root` / `wordpress`
- **Password**: `root` / `wordpress`
- **Volume**: `mysql_data` (persistent storage)
- **Auto-import**: SQL files in `./app/sql/` are imported on first run

### phpMyAdmin
- **Image**: `phpmyadmin/phpmyadmin:latest`
- **Port**: 8081
- **Username**: `root`
- **Password**: `root`

---

## 💾 Database Management

### Initial Import (Automatic)

SQL dumps placed in `./app/sql/` are automatically imported when the MySQL container starts for the first time. Your existing `local.sql` file will be imported automatically.

### Manual Import via phpMyAdmin

1. Go to [http://localhost:8081](http://localhost:8081)
2. Login with `root` / `root`
3. Select the `local` database
4. Click **Import** tab
5. Choose your SQL file
6. Click **Go**

### Manual Import via Command Line

```bash
# Copy SQL file to running container
docker cp ./app/sql/local.sql smart-electronics-mysql:/tmp/local.sql

# Import into database
docker exec -i smart-electronics-mysql mysql -uroot -proot local < /tmp/local.sql

# Clean up
docker exec smart-electronics-mysql rm /tmp/local.sql
```

### Export Database

```bash
# Export database to SQL file
docker exec smart-electronics-mysql mysqldump -uroot -proot local > ./app/sql/local-backup-$(date +%Y%m%d).sql
```

---

## 🛠️ Useful Commands

### View logs

```bash
# All services
docker compose logs -f

# Specific service
docker compose logs -f wordpress
docker compose logs -f mysql
docker compose logs -f nginx
docker compose logs -f phpmyadmin

# Last 100 lines
docker compose logs --tail=100 wordpress
```

### Restart services

```bash
# Restart all
docker compose restart

# Restart specific service
docker compose restart wordpress
docker compose restart nginx
```

### Stop containers

```bash
# Stop all containers
docker compose stop

# Stop and remove containers
docker compose down

# Stop and remove containers + volumes (WARNING: deletes database data!)
docker compose down -v
```

### Rebuild containers

```bash
# Rebuild and restart
docker compose up -d --build

# Force rebuild without cache
docker compose build --no-cache
docker compose up -d
```

### Execute commands in containers

```bash
# Access WordPress container
docker exec -it smart-electronics-wordpress bash

# Access MySQL container
docker exec -it smart-electronics-mysql bash

# Connect to MySQL directly
docker exec -it smart-electronics-mysql mysql -uroot -proot local

# Run WP-CLI (if installed in WordPress container)
docker exec -it smart-electronics-wordpress wp plugin list
```

### Check container resource usage

```bash
docker stats
```

---

## 🐛 Troubleshooting

### Port already in use

If port 8080 or 8081 is already in use:

```bash
# Check what's using the ports
sudo netstat -tulpn | grep -E '8080|8081'

# OR change ports in docker-compose.yml:
# ports:
#   - "8082:80"  # Change 8080 to 8082
```

### Permission issues

If you encounter file permission issues:

```bash
# Fix WordPress file permissions
sudo chown -R $USER:$USER /home/sharna/Documents/Smart-Electronics-Update/app/public
find /home/sharna/Documents/Smart-Electronics-Update/app/public -type d -exec chmod 755 {} \;
find /home/sharna/Documents/Smart-Electronics-Update/app/public -type f -exec chmod 644 {} \;
```

### Database connection errors

If WordPress can't connect to the database:

1. Check MySQL is running:
```bash
docker compose ps mysql
```

2. Check MySQL logs:
```bash
docker compose logs mysql
```

3. Verify wp-config.php has correct DB_HOST:
```bash
grep DB_HOST /home/sharna/Documents/Smart-Electronics-Update/app/public/wp-config.php
# Should show: define( 'DB_HOST', 'mysql' );
```

### WordPress site not loading

1. Check all containers are running:
```bash
docker compose ps
```

2. Check Nginx logs:
```bash
docker compose logs nginx
tail -f /home/sharna/Documents/Smart-Electronics-Update/logs/nginx/access.log
tail -f /home/sharna/Documents/Smart-Electronics-Update/logs/nginx/error.log
```

3. Restart Nginx:
```bash
docker compose restart nginx
```

### phpMyAdmin not accessible

1. Check phpMyAdmin container is running:
```bash
docker compose ps phpmyadmin
```

2. Verify MySQL is running (phpMyAdmin depends on it):
```bash
docker compose ps mysql
```

3. Check phpMyAdmin logs:
```bash
docker compose logs phpmyadmin
```

### Reset everything (fresh start)

```bash
# Stop and remove everything
docker compose down -v

# Remove all WordPress uploads cache (optional)
sudo rm -rf /home/sharna/Documents/Smart-Electronics-Update/app/public/wp-content/cache/*

# Start fresh
docker compose up -d
```

---

## 🔒 Security Notes

⚠️ **For local development only!**

This configuration uses default credentials:
- MySQL root password: `root`
- Database name: `local`

For production, you should:
1. Use strong, unique passwords
2. Change database credentials in `docker-compose.yml`
3. Update `wp-config.php` with new credentials
4. Use environment variables (`.env` file) for sensitive data
5. Enable SSL/HTTPS
6. Restrict phpMyAdmin access or remove it entirely

---

## 📝 Environment Variables

You can create a `.env` file in the project root to override defaults:

```bash
# .env
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=local
MYSQL_USER=wordpress
MYSQL_PASSWORD=wordpress
WORDPRESS_PORT=8080
PHPMYADMIN_PORT=8081
```

Then update `docker-compose.yml` to use these variables.

---

## 🔄 Updating WordPress/Plugins

Since the WordPress files are mounted as a volume, any changes you make through the WordPress admin (plugin updates, theme changes, uploads) will persist on your host system.

To update WordPress core via command line:

```bash
# Access WordPress container
docker exec -it smart-electronics-wordpress bash

# If WP-CLI is installed:
# wp core update
# wp plugin update --all
# wp theme update --all
```

---

## 📚 Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [WordPress Docker Image](https://hub.docker.com/_/wordpress)
- [MySQL Docker Image](https://hub.docker.com/_/mysql)
- [phpMyAdmin Docker Image](https://hub.docker.com/r/phpmyadmin/phpmyadmin)

---

## ✅ Verification Checklist

After starting the containers:

- [ ] `docker compose ps` shows all 4 services running
- [ ] [http://localhost:8080](http://localhost:8080) loads the WordPress site
- [ ] WordPress admin area accessible
- [ ] [http://localhost:8081](http://localhost:8081) loads phpMyAdmin
- [ ] Can login to phpMyAdmin with `root`/`root`
- [ ] Database `local` exists in phpMyAdmin
- [ ] WordPress can connect to database
- [ ] File uploads work in WordPress
- [ ] Plugins and themes load correctly

---

## 📞 Support

If you encounter issues not covered here:

1. Check Docker logs: `docker compose logs`
2. Check container status: `docker compose ps`
3. Verify ports are not in use: `sudo netstat -tulpn`
4. Check file permissions on `app/public/`
