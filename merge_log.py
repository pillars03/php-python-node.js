#!/usr/bin/python
# -*- coding: UTF-8 -*-

import os

def getAllFile(dir,file_arr=None):
    if file_arr is None:
        file_arr = []
    all_file = os.listdir(dir)
    for file in all_file:
        path = os.path.join(dir, file)
        if os.path.isdir(path):
            getAllFile(path,file_arr)
        else:
            file_arr.append(path)
    return file_arr
cc = getAllFile('20180703')
file = open('/tmp/ceshipy.log','a')
for log in cc:
    log_file = open(log)
    str = log_file.read()
    log_file.close()
    file.write(str)
file.close

    
