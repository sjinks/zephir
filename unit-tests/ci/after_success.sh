#!/bin/bash

PREFIX=$(readlink -enq "$(dirname $0)/../../")

if [ "$CC" = "gcc" -o "$CC" = "ccache gcc" -o "x$CC" = "x" ]; then
	GCOV=gcov
	ARGS="-ablp"

	rm -rf   "$PREFIX/.gcov"
	mkdir -p "$PREFIX/.gcov"

	DIRS=$(find "$PREFIX" -type f -name \*.gcno -printf "%h\n" | sort -u)

	for i in $DIRS; do
		(cd "$PREFIX"; $GCOV $ARGS -o "$i" "$i"/*.gcno)
	done

	mv "$PREFIX"/*.gcov "$PREFIX/.gcov"

	/bin/bash <(curl -s https://codecov.io/bash) -f "$PREFIX/.gcov/*.gcov" -X gcov
fi
