# Documentação da Classe Notification

A classe `Notification` fornece uma interface para criar notificações personalizadas usando a biblioteca SweetAlert 2.

## Métodos Disponíveis

1. **title($title)**
   - Define o título da notificação.
   ```php
   sweetAlert()->title('Título da Notificação');

2. **message($message)**
   - Define a mensagem da notificação.
   ```php
   sweetAlert()->message('Mensagem da Notificação');

3. **type($type)**
   - Define o tipo de ícone da notificação (ex: 'success', 'error', 'info', 'warning', 'question').
   ```php
   sweetAlert()->type('success');

4. **confirmButtonText($text)**
   - Define o texto do botão de confirmação.
   ```php
   sweetAlert()->confirmButtonText('OK');

5. **confirmButtonColor($confirmButtonColor)**
   - Define a cor do botão de confirmação.
   ```php
   sweetAlert()->confirmButtonColor('#007bff');

6. **cancelButtonText($text)**
   - Define o texto do botão de cancelamento.
   ```php
   sweetAlert()->cancelButtonText('Cancelar');

7. **reverseButtons($reverseButtons)**
   - Define se os botões de confirmação e cancelamento serão exibidos na ordem reversa.
   ```php
   sweetAlert()->reverseButtons(true);

8. **cancelButtonColor($cancelButtonColor)**
   - Define a cor do botão de cancelamento.
   ```php
   sweetAlert()->cancelButtonColor('#ff0000');

9. **position($position)**
   - Define a posição da notificação (ex: 'top', 'center', 'bottom').
   ```php
   sweetAlert()->position('top');

10. **timer($timer)**
    - Define um temporizador para fechar automaticamente a notificação após um período de tempo especificado em milissegundos. Se definido, a notificação não exibirá botões de confirmação ou cancelamento.
    ```php
   sweetAlert()->timer(5000); // Fecha a notificação após 5 segundos

11. **timerProgressBar($timerProgressBar)**
    - Define se a barra de progresso do temporizador deve ser exibida quando um temporizador é definido. (Padrão: `false`)
    ```php
   sweetAlert()->timerProgressBar(true); // Exibe a barra de progresso do temporizador

12. **footer($footer)**
    - Define o rodapé da notificação.
    ```php
   sweetAlert()->footer('Rodapé da Notificação');

13. **html($html)**
    - Define conteúdo HTML personalizado para a notificação. Ao usar este método, a mensagem padrão é substituída.
    ```php
   sweetAlert()->html('<p>Conteúdo HTML personalizado</p');

14. **onConfirm($callback)**
    - Define um callback que será executado quando o botão de confirmação for clicado.
    ```php
   sweetAlert()->onConfirm('function() { alert("Botão de confirmação clicado"); }');

15. **onCancel($callback)**
    - Define um callback que será executado quando o botão de cancelamento for clicado.
    ```php
   sweetAlert()->onCancel('function() { alert("Botão de cancelamento clicado"); }');

16. **imageUrl($imageUrl)**
    - Define uma URL de imagem para ser exibida na notificação.
    ```php
   sweetAlert()->imageUrl('https://example.com/image.png');

17. **imageWidth($imageWidth)**
    - Define a largura da imagem na notificação em pixels. (Padrão: 400)
    ```php
   sweetAlert()->imageWidth(300); // Define a largura da imagem como 300 pixels

18. **imageHeight($imageHeight)**
    - Define a altura da imagem na notificação em pixels. (Padrão: 200)
    ```php
   sweetAlert()->imageHeight(150); // Define a altura da imagem como 150 pixels

19. **imageAlt($imageAlt)**
    - Define o texto alternativo da imagem na notificação.
    ```php
   sweetAlert()->imageAlt('Descrição da imagem');

20. **show()**
    - Exibe a notificação com todas as configurações definidas.
    ```php
   sweetAlert()->show();
É importante lembrar que a biblioteca SweetAlert 2 deve ser incluída em seu projeto para que esse código funcione corretamente. Certifique-se de que a biblioteca esteja disponível no seu ambiente de desenvolvimento.

# Exemplos de Uso da Classe Notification

## Exemplo 1: Notificação de Sucesso Simples
Para criar uma notificação de sucesso simples com um título e uma mensagem, você pode fazer o seguinte:
```php
sweetAlert()
    ->title('Sucesso!')
    ->message('A operação foi concluída com êxito.')
    ->type('success')
    ->show()
```

## Exemplo 2: Notificação com Temporizador
Para criar uma notificação que se fecha automaticamente após alguns segundos, você pode definir um temporizador:
```php
sweetAlert()
    ->title('Aguarde...')
    ->message('Esta notificação será fechada em 5 segundos.')
    ->timer(5000)
    ->show();
```

## Exemplo 3: Notificação com Botões de Confirmação e Cancelamento
Você pode criar uma notificação com botões de confirmação e cancelamento, juntamente com callbacks para ações personalizadas:
```php
sweetAlert()
    ->title('Confirmação necessária')
    ->message('Tem certeza de que deseja excluir este item?')
    ->type('warning')
    ->showConfirmButton(true)
    ->confirmButtonText('Sim, excluir')
    ->showCancelButton(true)
    ->cancelButtonText('Cancelar')
    ->onConfirm('function() { alert("Item excluído com sucesso."); }')
    ->onCancel('function() { alert("A exclusão foi cancelada."); }')
    ->show();
```

## Exemplo 4: Notificação com Botões de Confirmação e Cancelamento
Você pode adicionar uma imagem personalizada a uma notificação:
```php
sweetAlert()
    ->title('Nova Mensagem')
    ->message('Você tem uma nova mensagem!')
    ->imageUrl('https://example.com/message.png')
    ->imageWidth(100)
    ->imageHeight(100)
    ->show();
```

## Exemplo 5: Notificação com temporizador na tela
Exibira um toast com por exemplo 2000ms na tela, (carregando...)
Obs: obrigatório a tag "<b></b>" para que mostre os milissegundos restantes, no timer define quanto tempo o toast ficara na tela
```php
sweetAlert()
    ->title('Auto close alert!')
    ->html('I will close in <b></b> milliseconds.')
    ->timer(2000)
    ->show();
```

## Exemplo 6: Notificação toast com redirecionamento
Exibe um toast na direita e após 1500ms redirecionar para o app definido
```php
   sweetAlert()
      ->title('Sucesso!')
      ->message('A prospecção foi cadastrada com sucesso!')
      ->type('success')
      ->toast(true)
      ->position('top-right')
      ->onRedir(['app'=>'form_funil', 'variaveis'=>'id_funil=1&_passoAtual=0','tipo'=>$tipoRedir])
      ->show();
```