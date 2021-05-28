# Object-Oriented Programming in C

## Prologue

This article illustrates simulated classes and objects in pure C.

## Synopsis

```c
/* main.c */
#include <stdio.h>
#include <stdlib.h>
#include "point.h"

#define PUTERR(format, ...) \
  fprintf(stderr, format "\n", ##__VA_ARGS__);

int main(void)
{
    point_t *p = NULL;
    point_t *q = NULL;
    double d;

    p = point_zero();
    if (!p) {
        PUTERR("Fails to create p");
        goto ERROR_MAIN;
    }

    q = point_new(3.0, 4.0);
    if (!q) {
        PUTERR("Fails to create q");
        goto ERROR_MAIN;
    }

    if (!(3.0 == point_x(q))) {
        PUTERR("Wrong value x: %.2f", point_x(q));
        goto ERROR_MAIN;
    }

    if (!(4.0 == point_y(q))) {
        PUTERR("Wrong value y: %.2f", point_y(q));
        goto ERROR_MAIN;
    }

    d = point_distance_between(p, q);
    if (!(5.0 == d)) {
        PUTERR("Wrong distance: %.2f", d);
        goto ERROR_MAIN;
    }

    point_delete((void *) q);
    point_delete((void *) p);

    return 0;

ERROR_MAIN:
    if (q)
        point_delete((void *) q);

    if (p)
        point_delete((void *) p);

    return 1;
}
```
