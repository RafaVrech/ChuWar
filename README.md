# ChuWar
Exercício War PHP

Funcional:
  1. O usuário digita seu nome de usuário para entrar no sistema. Não é necessário senha (se quiser implementar, pode) 
  
  2. O sistema checa se existe uma partida em aberto para o usuário. Se sim, vai para a tela de partida; se não, cria uma partida e vai para a tela da partida. 
  
  3. Existem dois jogadores: o computador e o usuário. 
  
  4. No início de uma partida, os países disponíveis são divididos aleatoriamente entre os jogadores. Cada país recebe 3 exércitos. 
  
  6. Na tela de partida, o usuário deve ver uma tabela com uma lista dos países, o dono do país (ele ou o computador) e o número de exércitos no país. 
  
  7. Na tela de partida, o usuário deve poder selecionar um ataque, sempre com um país de origem (seu) e um país de destino (do computador). A decisão de como será a interface de seleção do ataque fica por sua conta. Deve ser levado em consideração que o país de origem do ataque deve ter fronteira com o país de destino. 
    
  9. Logo em seguida, estamos em uma nova rodada. É exibido para o usuário a mesma tela da partida, com os resultados dos ataques e a tela atualizada para ele poder fazer nova jogada. 
  
  5. A cada jogada, cada jogador recebe 6 exércitos, distribuídos aleatoriamente pelo mapa. 
  
  10. A apuração do resultados dos ataques deve se dar da seguinte maneira: para cada exército do país de origem é rodado um número aleatório de 0 a 10. Se o número for maior que cinco, o atacante ganha e destrói um exército do inimigo. Caso todos os exércitos inimigos sejam destruídos, o país é ocupado com 1 exército. 
  
  12. O jogo se encerra quando um dos jogadores tiver sido destruído. 
  
To-Do:
  
  8. Ao submeter o formulário, o ataque é processado. Por questão de simplicidade, a rodada é encerrada após a apuração desse ataque e, no mesmo request, o computador faz sua jogada. 
   
  11. O computador vai sempre fazer o ataque em que tenha a maior vantagem em número de exércitos do país de origem sobre o país de destino. Por exemplo, se ele tiver a possibilidade de atacar de um país de 10 sobre um país com 5 exércitos, versus a possibilidade de atacar de um país de 8 sobre um de 1, ele vai escolher a segunda opção. 
  
  
