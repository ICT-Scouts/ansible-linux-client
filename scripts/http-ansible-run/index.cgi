#!/usr/bin/python3
import os
import sys
import socket

# Variables
ANSIBLE_PASSWORD = "" # USE SSH KEYS!
ANSIBLE_PATH = "/root/ansible-deploy" # No trailing Slash

# Remove SSH known hosts as different machines
# get the same IP via DHCP sometimes
os.system("sudo rm -rf /root/.ssh/known_hosts")

# Get query string
query_string = os.getenv("QUERY_STRING")
params = {}
for x in query_string.split("&"):
    split_query = x.split("=")
    params[split_query[0]]=split_query[1]

print("Content-Type: text/plain\n\n")
print(params["ip"])
try:
    socket.inet_aton(params["ip"])
    # os.spawnl(os.P_NOWAIT, 
    os.system("sudo sh -c \"ansible-playbook {2}/playbook.yml -i '{0},' -e 'ansible_password={1} ansible_become_pass={1} ansible_python_interpreter=/bin/python3' > /var/log/ansible/{0}.log 2>&1 &\"".format(params['ip'], ANSIBLE_PASSWORD, ANSIBLE_PATH))#, [" "])
    print(f"Deployment started. Visit http://10.10.0.5/logs?ip={params['ip']} for logs.")
except Exception as e:
    print(e)
    print("Invalid IP.")



