# Object-Oriented Programming in C

## Prologue

This article illustrates simulated classes and objects in pure C.

## Example

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

```c
/* point.h */
#pragma once

/* An opaque struct. */
typedef struct point_t point_t;

#ifdef __cplusplus
extern "C" {
#endif

    point_t * point_zero(void);
    point_t * point_new(double x, double y);
    void point_delete(void *self);
    double point_x(point_t *self);
    double point_y(point_t *self);
    double point_distance_between(point_t *p, point_t *q);

#ifdef __cplusplus
}
#endif
```

```c
/* point.c */
#include <assert.h>
#include <math.h>
#include <stdlib.h>
#include "point.h"

struct point_t {
    double x;
    double y;
};

point_t * point_zero(void)
{
    return point_new(0.0, 0.0);
}

point_t * point_new(double x, double y)
{
    point_t *self = \
        (point_t *) malloc(sizeof(point_t));
    if (!self)
        return self;

    point_set_x(self, x);
    point_set_y(self, y);

    return self;
}

void point_delete(void *self)
{
    if (!self)
        return;

    free(self);
}

double point_x(point_t *self)
{
    assert(self);

    return self->x;
}

double point_y(point_t *self)
{
    assert(self);

    return self->y;
}

double point_distance_between(point_t *p, point_t *q)
{
    assert(p && q);

    double dx = point_x(p) - point_x(q);
    double dy = point_y(p) - point_y(q);

    return sqrt(dx * dx + dy * dy);
}
```

## README

C lacks built-in supports to object-oriented programming. Therefore, we simulate classes and objects with C struct.
