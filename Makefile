vite:
	cd frontend; \
	../vendor/bin/sail npm run dev

start:
	./vendor/bin/sail up -d

stop:
	./vendor/bin/sail stop

restart:
	./vendor/bin/sail restart
