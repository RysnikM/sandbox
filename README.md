
### Start ansible playbook for install docker
``` bash
ansible-playbook ci_docker.yaml
```

### For create sudo pass use sc
``` bash
python3 -c 'import crypt; print(crypt.crypt("<Требуемый пароль>"))'
```
---
