# Widgets ead — Plugin WordPress (Elementor)

Plugin com uma coleção de **widgets personalizados para Elementor** e um conjunto de **scripts/estilos** voltados a experiências educacionais e interativas (NEAD/ead).

> Versão no código: **2.4**  
> Autor no código: **Aidan W. Bruno**

---

## Sumário
- [O que é](#o-que-é)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Atualização](#atualização)
- [Como usar no Elementor](#como-usar-no-elementor)
- [Widgets inclusos](#widgets-inclusos)
- [Navegação horizontal em Container](#navegação-horizontal-em-container)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Tecnologias utilizadas](#tecnologias-utilizadas)
- [Boas práticas e dicas](#boas-práticas-e-dicas)
- [Solução de problemas](#solução-de-problemas)
- [Changelog (resumo do que aparece no código)](#changelog-resumo-do-que-aparece-no-código)
- [Licença](#licença)

---

## O que é
O **Widgets ead** adiciona uma categoria própria ao Elementor — **“Widgets ead”** — com componentes pensados para **conteúdos educacionais, quizzes, hotspots, cartões animados, steps/etapas, popups e efeitos de digitação**. Todo o carregamento de **CSS/JS** específico de cada widget é feito pelo plugin.

## Requisitos
- **WordPress** 5.8+ (recomendado 6.x)
- **Elementor** 3.x (Elementor gratuito é suficiente para os widgets; o Pro pode agregar recursos adicionais, mas não é obrigatório)
- PHP 7.4+ (recomendado 8.x)

> Dica: mantenha WP/Elementor atualizados para melhor compatibilidade e segurança.

## Instalação
### Opção A — Envio do ZIP pelo painel
1. Acesse **Plugins → Adicionar novo → Enviar plugin**.
2. Selecione o arquivo **`custom-ead.zip`**.
3. Clique em **Instalar** e depois em **Ativar**.

### Opção B — Instalação manual via FTP/SSH
1. Descompacte o arquivo `custom-ead.zip`.
2. Envie a pasta **`custom-ead/`** para `wp-content/plugins/` do seu site.
3. No painel do WP, vá em **Plugins** e clique em **Ativar** no *Widgets ead*.

## Atualização
- Para atualizar manualmente, repita o processo de instalação substituindo a pasta do plugin.  
- Em produção, faça **backup** e teste em **staging** quando possível.

## Como usar no Elementor
1. Edite uma página/modelo com o **Elementor**.
2. No painel de widgets, procure a categoria **“Widgets ead”**.
3. **Arraste** o widget desejado para a área de edição.
4. Configure os campos no painel lateral (conteúdo, estilo e avançado).  
5. Publique/Atualize a página.

> O plugin também adiciona uma **opção de navegação horizontal** em *Container*.

## Widgets inclusos
(Detalhes dos widgets conforme documentação acima.)

## Tecnologias utilizadas
- **WordPress/Elementor API** (PHP)
- **PHP**
- **CSS3**
- **JavaScript (jQuery)**

## Licença
GPL v2 ou posterior.
