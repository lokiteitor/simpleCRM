#!/bin/bash
docker stop CRM-DB
docker stop CRM-HTTP
docker rm CRM-DB
docker rm CRM-HTTP