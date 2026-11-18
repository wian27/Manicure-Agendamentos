# Teste no Android — Agenda Pro (demonstração)

A demonstração ainda não tem banco, autenticação nem sincronização entre aparelhos. Os dados ficam no armazenamento local do navegador; não use dados pessoais reais.

## Instalação e offline
1. Publique a pasta `nova-versao` em HTTPS e abra o endereço no Chrome Android.
2. Aguarde a primeira visita online para que o service worker instale e guarde os arquivos.
3. Use o menu do Chrome para instalar/adicionar à tela inicial, se disponível.
4. Ative o modo avião e reabra o aplicativo pelo mesmo endereço ou ícone.
5. Confira se a tela, estilos e ações locais continuam funcionando. Se não, registre o navegador e a mensagem de erro.

## Recuperação
1. Cadastre apenas dados fictícios.
2. Use **Exportar JSON** e confirme que o arquivo foi baixado.
3. Em outro perfil de navegador, abra a demonstração e use **Importar JSON**.
4. Confirme que clientes, serviços e agendamentos foram recuperados.
5. Não limpe os dados do navegador antes de guardar o backup; a instalação PWA não garante preservação após limpeza ou troca de aparelho.

## Limitações
- Não existe sincronização automática, backup em nuvem ou recuperação de dados perdidos.
- O cache offline guarda somente os arquivos públicos da demonstração, não os registros locais.
- Uma compilação/verificação de sintaxe aprovada não comprova que os passos acima passaram no dispositivo.
