#!/usr/bin/python
# -*- coding: UTF-8 -*-


def getCount(n):
    if n == 1:
        return 1
    if n == 2:
        return 2
    if n == 3:
        return 4
    return getCount(n - 1) + getCount(n - 2) + getCount(n - 3)
print getCount(4)


def getStop(n):
    stops = [0] * (n + 1)
    stops[0] = 1
    if n >= 1:
        stops[1] = 1
    if n >= 2:
        stops[2] = 2
    for circle in range(3, n + 1):
        stops[circle] = stops[circle - 3] + \
            stops[circle - 2] + stops[circle - 1]
    return stops[n]

print getStop(5)