# File: patch-301.sql
# Script Name: vAuthenticate 4.0
# Author: ZYMO

# Change password columns in authuser table
ALTER TABLE authuser CHANGE passwd passwd VARCHAR( 32 ) NOT NULL;
