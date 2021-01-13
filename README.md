
### Check ssh server:
``` bash
dpkg -l | grep ssh
```
### Install openssh server
``` bash
sudo apt install openssh-server -y
```

### Check ansible hosts:
``` bash
sudo echo "localhost ansible_connection=local ansible_python_interpreter=/usr/bin/python3 " >> /etc/ansible/hosts
```

### Start ansible playbook for install docker
``` bash
ansible-playbook ci_docker.yaml
```

### For create sudo pass use sc
``` bash
python3 -c 'import crypt; print(crypt.crypt("<Требуемый пароль>"))'
```
---
