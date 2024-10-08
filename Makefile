vite:
	cd frontend; \
	../vendor/bin/sail npm run dev

start:
	./vendor/bin/sail up -d

stop:
	./vendor/bin/sail stop

delete:
	./vendor/bin/sail stop -v

restart:
	./vendor/bin/sail restart
