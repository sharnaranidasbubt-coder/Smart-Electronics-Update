#!/bin/bash
# Smart Electronics WordPress - Docker Helper Script
# Version: 1.0
# Description: Quick commands for managing Docker containers

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Project directory
PROJECT_DIR="/home/sharna/Documents/Smart-Electronics-Update"

# Help menu
show_help() {
    cat << EOF
${GREEN}Smart Electronics WordPress - Docker Helper${NC}

${YELLOW}Usage:${NC} ./docker.sh [command]

${BLUE}Commands:${NC}
  start           Start all Docker containers
  stop            Stop all Docker containers
  restart         Restart all Docker containers
  status          Show status of all containers
  logs            Show logs from all containers (follow mode)
  logs-wordpress  Show WordPress container logs
  logs-mysql      Show MySQL container logs
  logs-nginx      Show Nginx container logs
  logs-phpmyadmin Show phpMyAdmin container logs

  shell-wordpress Access WordPress container shell
  shell-mysql     Access MySQL container shell
  mysql-connect   Connect directly to MySQL console

  db-export       Export database to app/sql/local-backup-YYYYMMDD.sql
  db-import       Import database from app/sql/local.sql

  clean           Remove all containers (keeps volumes)
  clean-all       Remove all containers and volumes (deletes data!)

  help            Show this help message

${BLUE}Examples:${NC}
  ./docker.sh start
  ./docker.sh logs
  ./docker.sh db-export

${BLUE}URLs:${NC}
  WordPress:  http://localhost:8080
  phpMyAdmin: http://localhost:8081

EOF
}

# Check if we're in the project directory
check_dir() {
    if [[ ! -f "$PROJECT_DIR/docker-compose.yml" ]]; then
        echo -e "${RED}Error: docker-compose.yml not found in $PROJECT_DIR${NC}"
        echo "Please navigate to the project directory or update PROJECT_DIR in this script."
        exit 1
    fi
}

# Start containers
start_containers() {
    check_dir
    echo -e "${BLUE}Starting Docker containers...${NC}"
    cd "$PROJECT_DIR"
    docker compose up -d
    echo -e "${GREEN}✓ Containers started${NC}"
    echo ""
    echo -e "${YELLOW}Access your site at:${NC}"
    echo -e "  WordPress:  ${GREEN}http://localhost:8080${NC}"
    echo -e "  phpMyAdmin: ${GREEN}http://localhost:8081${NC}"
    echo ""
}

# Stop containers
stop_containers() {
    check_dir
    echo -e "${BLUE}Stopping Docker containers...${NC}"
    cd "$PROJECT_DIR"
    docker compose stop
    echo -e "${GREEN}✓ Containers stopped${NC}"
}

# Restart containers
restart_containers() {
    check_dir
    echo -e "${BLUE}Restarting Docker containers...${NC}"
    cd "$PROJECT_DIR"
    docker compose restart
    echo -e "${GREEN}✓ Containers restarted${NC}"
}

# Show container status
show_status() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${BLUE}Container Status:${NC}"
    echo ""
    docker compose ps
}

# Show logs
show_logs() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${BLUE}Showing logs (Ctrl+C to exit)...${NC}"
    docker compose logs -f
}

# Show specific service logs
show_service_logs() {
    check_dir
    cd "$PROJECT_DIR"
    local service=$1
    echo -e "${BLUE}Showing $service logs (Ctrl+C to exit)...${NC}"
    docker compose logs -f "$service"
}

# Access WordPress shell
shell_wordpress() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${BLUE}Accessing WordPress container shell...${NC}"
    docker exec -it smart-electronics-wordpress bash
}

# Access MySQL shell
shell_mysql() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${BLUE}Accessing MySQL container shell...${NC}"
    docker exec -it smart-electronics-mysql bash
}

# Connect to MySQL console
mysql_connect() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${BLUE}Connecting to MySQL console...${NC}"
    echo -e "${YELLOW}(Enter 'exit' to quit MySQL console)${NC}"
    docker exec -it smart-electronics-mysql mysql -uroot -proot local
}

# Export database
export_database() {
    check_dir
    cd "$PROJECT_DIR"
    local backup_file="app/sql/local-backup-$(date +%Y%m%d-%H%M%S).sql"

    echo -e "${BLUE}Exporting database...${NC}"
    docker exec smart-electronics-mysql mysqldump -uroot -proot local > "$backup_file"

    if [[ $? -eq 0 ]]; then
        echo -e "${GREEN}✓ Database exported to: $backup_file${NC}"
    else
        echo -e "${RED}✗ Export failed${NC}"
        exit 1
    fi
}

# Import database
import_database() {
    check_dir
    cd "$PROJECT_DIR"
    local sql_file="app/sql/local.sql"

    if [[ ! -f "$sql_file" ]]; then
        echo -e "${RED}Error: $sql_file not found${NC}"
        exit 1
    fi

    echo -e "${YELLOW}Warning: This will overwrite the 'local' database. Continue? (y/N)${NC}"
    read -r response

    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        echo "Import cancelled."
        exit 0
    fi

    echo -e "${BLUE}Importing database...${NC}"
    docker exec -i smart-electronics-mysql mysql -uroot -proot local < "$sql_file"

    if [[ $? -eq 0 ]]; then
        echo -e "${GREEN}✓ Database imported from: $sql_file${NC}"
    else
        echo -e "${RED}✗ Import failed${NC}"
        exit 1
    fi
}

# Clean containers (keeps volumes)
clean() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${YELLOW}This will stop and remove all containers (keeps database data).${NC}"
    echo -e "Continue? (y/N)"
    read -r response

    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        echo "Operation cancelled."
        exit 0
    fi

    echo -e "${BLUE}Removing containers...${NC}"
    docker compose down
    echo -e "${GREEN}✓ Containers removed${NC}"
}

# Clean all (removes volumes too)
clean_all() {
    check_dir
    cd "$PROJECT_DIR"
    echo -e "${RED}Warning: This will DELETE ALL DATA including the database!${NC}"
    echo -e "Continue? (y/N)"
    read -r response

    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        echo "Operation cancelled."
        exit 0
    fi

    echo -e "${RED}Deleting everything...${NC}"
    docker compose down -v
    echo -e "${GREEN}✓ All containers and volumes removed${NC}"
}

# Main script logic
case "${1:-help}" in
    start)
        start_containers
        ;;
    stop)
        stop_containers
        ;;
    restart)
        restart_containers
        ;;
    status)
        show_status
        ;;
    logs)
        show_logs
        ;;
    logs-wordpress)
        show_service_logs "wordpress"
        ;;
    logs-mysql)
        show_service_logs "mysql"
        ;;
    logs-nginx)
        show_service_logs "nginx"
        ;;
    logs-phpmyadmin)
        show_service_logs "phpmyadmin"
        ;;
    shell-wordpress)
        shell_wordpress
        ;;
    shell-mysql)
        shell_mysql
        ;;
    mysql-connect)
        mysql_connect
        ;;
    db-export)
        export_database
        ;;
    db-import)
        import_database
        ;;
    clean)
        clean
        ;;
    clean-all)
        clean_all
        ;;
    help|--help|-h)
        show_help
        ;;
    *)
        echo -e "${RED}Unknown command: $1${NC}"
        echo ""
        show_help
        exit 1
        ;;
esac
