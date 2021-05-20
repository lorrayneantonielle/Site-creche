_Commit de alteração da paleta de cores do index.html - 20/05/2021
> Deixando o site mais moderno


_Commit de alterações de pastas - 14/04/2021_
# Organização dos arquivos e pastas
> Mais a frente você vai trabalhar com padrões de projetos e é muito comum usar as pastas assim. 

Estou utilizando alguns recursos da estrutura MVC, veja mais em [padrões MVC](https://www.treinaweb.com.br/blog/o-que-e-mvc/). Contudo não se apegue a esses conceitos, mais a frente vai ficando mais fácil trabalhar com eles.
### Movendo os arquivos
Os arquivos complementares da página (javascript, css, imagens, fontes de texto, plugins, ícones) ficam em uma pasta chamada **assets**. Sendo assim criei a pasta e movi os arquivos para lá.
### Nomeando os arquivos
Para nomear as pastas de arquivos web não é necessário colocar qualquer caractere antes do nome da pasta, a menos que você esteja utilizando algum framework específico, veja mais sobre  [o que são frameworks](https://tableless.github.io/iniciantes/manual/js/o-que-framework.html).
### Ajustando o caminho dos links
Como fizemos a mudança das pastas é necessário alterar o nome dos caminhos também, como segue a imagem abaixo.

![image](https://user-images.githubusercontent.com/32823495/114801013-4508c500-9d71-11eb-922c-a326c04d0217.png)

_Commit de identação e implementação do MD_

# Identação
Identar um texto faz com que ele seja mais legível, assim sendo mais fácil de dar manutenção, encontrar problemas e eventuais chateações em seu código, além de deixar ela muito mais bonito.

![image](https://media.giphy.com/media/l3V0dy1zzyjbYTQQM/giphy.gif)

Para fazer isso apenas aperte tab que ele vai dar alguns espaços, geralmente 4, mas dependendo do seu editor você consegue alterar a quantidade de espaços.

### Uma pequena correção
Tudo que estiver fora da tag `<body>...</body>` não será lido. Quer dizer, até que vai ser lido, mas é errado colocar do lado de fora, então tomei a liberdade de mover o footer para dentro da tag, assim evita do elemento ter algum erro futuramente.

![image](https://media.giphy.com/media/5oOPvZJVEx6Za/giphy.gif)

# Markdown
Ahhh sim, ta vendo esse arquivo `README.MD`? É ele o objeto de entrada dos seus arquivos, se chama markdown, então sempre que for fazer uma apresentação dos seus projetos você pode editar ele, colocando informações indispensáveis do seu produto. 

Tem um tutorial aqui de [como deixar seu markdown bonitão](https://raullesteves.medium.com/github-como-fazer-um-readme-md-bonit%C3%A3o-c85c8f154f8#:~:text=md%20%C3%A9%20um%20arquivo%20markdown,tags%20tamb%C3%A9m%20funcionam%2C%20veremos%20adiante.&text=Basta%20copiar%20o%20que%20o,e%20colar%20no%20README.md.). 

Segue o link oficial também do GITHUB contendo dicas de formatar ele. [Markdown](https://guides.github.com/features/mastering-markdown/)
