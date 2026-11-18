# Modernização do Manicure-Agendamentos

## Diagnóstico (18/11/2026)
O projeto legado utiliza PHP, MySQLi e Bootstrap 5. Contém cadastro de clientes, agendamentos, histórico e perfil. Esta branch preserva o código original em master.

## Riscos a corrigir antes de disponibilizar
- Adicionar autenticação e autorização para todas as páginas e ações de clientes e agendamentos.
- Desabilitar display_errors e remover var_dump de dados enviados.
- Mover credenciais do banco para variáveis de ambiente e usar conta de banco com privilégios mínimos.
- Validar campos no servidor; escapar saídas HTML com htmlspecialchars.
- Proteger POSTs com tokens CSRF e validar permissões em alterações e exclusões.
- Validar conflitos de horários e evitar agendamentos duplicados.
- Criar esquema/migrações de banco reproduzíveis e testes.

## Plano de entrega
1. Inventariar as tabelas reais e definir esquema de clientes, profissionais, serviços e agendamentos.
2. Implementar login seguro, sessões, papéis e isolamento por profissional.
3. Refatorar CRUD com validação, proteção CSRF e consultas preparadas.
4. Implementar agenda responsiva, bloqueio de horários e estados de atendimento.
5. Adicionar notificações por WhatsApp somente com consentimento e integração oficial.
6. Criar PWA, política de privacidade, exclusão de conta, backup e testes de segurança.
7. Publicar em hospedagem que execute PHP e MySQL; GitHub Pages sozinho não executa PHP.

## Observações
Não há evidência de banco de dados configurado ou testes de execução nesta auditoria. Não publicar o legado como está. Nenhum repositório deve ser apagado apenas por semelhança de nome.
