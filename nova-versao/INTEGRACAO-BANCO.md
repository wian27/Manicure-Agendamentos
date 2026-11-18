# Integração futura com banco de dados

A aplicação atual é uma demonstração offline em localStorage. **Não cadastrar dados reais**.

## Contrato proposto
- Autenticação com provedor confiável, verificação de e-mail, recuperação de senha e encerramento de sessão.
- Tabelas: professionals(id,user_id), clients(id,professional_id,name,phone), services(id,professional_id,name,minutes,price), appointments(id,professional_id,client_id,service_id,start_at,end_at,status).
- Cada operação deve exigir sessão válida e aplicar isolamento por professional_id no servidor/banco (RLS quando aplicável).
- Impedir conflitos de horários com validação transacional no servidor; validação no navegador não é suficiente.
- Separar acesso a dados da interface: listClients, saveClient, listServices, saveService, listAppointments, saveAppointment e updateAppointmentStatus.
- Importar dados locais somente após autenticação, com consentimento e validação no servidor.
- Incluir exclusão de conta e dados, exportação, retenção e política LGPD antes do lançamento.

## Pendente
Escolher provedor, configurar credenciais seguras, migrações, regras de autorização, API, testes automatizados, testes com usuários e hospedagem HTTPS. Não inserir segredos no GitHub.
