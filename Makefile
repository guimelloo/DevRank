.PHONY: help up down

help:
	@echo "DevRank Project - Available Commands"
	@echo "===================================="
	@echo "  make up     - Start all containers"
	@echo "  make down   - Stop all containers"
	@echo "  make help   - Show this help message"

up:
	docker-compose up -d

down:
	docker-compose down
