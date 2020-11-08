
### Start ansible playbook
``` bash
ansible-playbook -i inv.yaml play.yaml
```

### For create sudo pass use sc
``` bash
python3 -c 'import crypt; print(crypt.crypt("<Требуемый пароль>"))'
```
---
