class Card {
  constructor(number, actionList){
    this.actions = {
      addSweet: function (){
          game.addSweetToPlayer();
      },
      coffee: function (){
        game.coffee();
      },
      drawCard: function (){
        game.drawCardFromDeck();

      },
      presentBelowStack: function (){
        game.presentBelowStack();
      },
      cardsIntoPast: function (){

      },
      cardsFromPast: function (){

      },
      oneCardToFuture: function (){

      },
      exchangeCards: function (){

      },
      allCardsToFuture: function (){

      },
      removeSweets: function (){

      }
    }

    this.number = number;
    this.actionList = [];
    var temp = {};
    for(var i = 0;i<actionList.length;i++){
      temp.action = actionList[i];
      temp.activated = 0;
      if(temp.action.substr(0,8)=="drawCard"){
          temp.draw = Number(temp.action.replace('drawCard', ""));
          temp.action = 'drawCard';
      }
      if(this.actions[temp.action]!==undefined){
        this.actionList.push(temp);
      }else{
        console.log("UNDEFIED ACTION ["+actionList[i]+"]");
      }
    }
  }
  removeSweetFromCard(){
    for(var i = 0;i<this.actionList.length;i++){
        if(this.actionList[i].activated==1){
          this.actionList[i].activated = 0;
          game.addSweetToStash();
        }
    }
  }
  hasAction(action){
    for(var i = 0;i<this.actionList.length;i++){
      if(this.actionList[i].action==action){
        return true;
      }
    }
    return false;
  }
  activateAction(text){
    if(this.hasAction(text)){
      for(var i = 0;i<this.actionList.length;i++){
          if(this.actionList[i].action==text&&this.actionList[i].activated==0){
            this.actions[text]();
            this.actionList[i].activated = 1;
            return;
          }
      }
    }
  }
}

  class cardList {
      constructor(){
        this.list = [];
      }
      shuffle() {
        var currentIndex = this.list.length, temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

          // Pick a remaining element...
          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex -= 1;

          // And swap it with the current element.
          temporaryValue = this.list[currentIndex];
          this.list[currentIndex] = this.list[randomIndex];
          this.list[randomIndex] = temporaryValue;
        }
      }

      nextScore(){
        if(this.list.length==0){
          return 1;
        }else{
          return Number(this.list[0].number)+1;
        }
      }

      score(n){
        for(var i = 0;i<this.list.length;i++){
          if(this.list[i].number==n){
            return this.list.splice(i, 1)[0];
          }
        }
        return false;
      }

      drawCard(){
          if(this.list.length==0){
            return false;
          }else{
            return  this.list.splice(0,1)[0];
          }
      }

      addCardTop(card){
        if(card!==undefined&&card!==false){
            this.list.unshift(card);
        }
      }

      addCardBottom(card){
        if(card!==undefined&&card!==false){
            this.list.push(card);
        }
      }

      sort(){
        this.list.sort(function (a, b){
            if(a.number>b.number){
              return 1;
            }else if (a.number<b.number){
              return -1;
            }
            return 0;
        });
      }
      removeSweets(){
        for(var i = 0;i<this.list.length;i++){
          this.list[i].removeSweetFromCard();
        }
      }
  }

  class Game {
    constructor(){

    }

    beginGame(){
          this.sweetStash = 3;
          this.sweetPlayer = 7;
          this.coffee = 7;
          this.future = {
            listOfCardLists: []
          };
          this.deck =  new cardList();
          this.present = new cardList();
          this.past = new cardList();
          this.finished = new cardList();
          this.nextTurnCards = new cardList();
          this.makeDeck();
          console.log("GAME STARTED");
          this.beginTurn();
    }

    consoleCard(card){
      var txt1 = "", txt2 = "",  txt3 = "", txt4 = "", txt5 = "", temp = "";
      txt1 += "------ ";
      if(card.number<10){
        txt2+= "-  "+card.number+" - ";
      }else{
        txt2+= "- "+card.number+" - ";
      }
      for(var j = 0;j<card.actionList.length;j++){
          temp += this.getShortAction(card.actionList[j].action);
          if(card.actionList[j].action=="drawCard"){
            temp += card.actionList[j].draw;
          }
          temp += ""
      }
      txt3+= "------ ";
      txt4+= "-";
      txt4+= temp;
      for(var j=0;j<4-temp.length;j++){
        txt4+= " ";
      }
      txt4+= "- ";
      txt5+= "------ ";
      console.log(txt1);
      console.log(txt2);
      console.log(txt3);
      console.log(txt4);
      console.log(txt5);
    }

    drawCardFromDeck(){
      console.log("DREW FROM DECK");
      var card = this.deck.drawCard();
      this.consoleCard(card);
      if(card){
        this.present.addCardTop(card);
        if(card.hasAction('addSweet')){
            game.addSweetToPlayer();
        }
      }
      //console.log("NEXT SCORE: "+this.finished.nextScore());
      do{
        card = this.present.score(this.finished.nextScore());
        if(card){
            console.log("SCORED! SCORED! SCORED! SCORED! SCORED! SCORED!");
            this.consoleCard(card);
            console.log("SCORED! SCORED! SCORED! SCORED! SCORED! SCORED!");
            this.finished.addCardTop(card);
            if(this.finished.list.length==48){
                console.log("             YOU WON!   :D       ");
                console.log("                -                ");
                console.log("               ---               ");
                console.log("             --------            ");
                console.log("           -----------           ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
                console.log("               ---               ");
            }else{
                this.drawCardFromDeck();
            }
        }
      }while(card!==false);
    }

    beginTurn(){
      console.log ("-+-+-  BEGGINING TURN  +-+-+-+-+-+-+-+-+-+-+");
      this.drawCardFromDeck();
      this.drawCardFromDeck();
      this.drawCardFromDeck();
      this.showGameState();
    }

    endTurn(){
      console.log ("-*-*-  ENDING TURN *-*-*-*-*-*-*-*-*-*-*-");
        //Get sweets for every chain of consecutive cards (Min 3 cards per chain, chainlen-1 sweets)
        var totalSweets = 0, lastNumber, counter = 0, cur;
        for(var i = 0;i<this.present.list.length;i++){
          cur = this.present.list[i];
          if(lastNumber!==undefined){
            if(lastNumber==cur.number-1){
               counter++;
            }else{
              if(counter>=3){
                totalSweets += counter-1;
              }
              counter = 0;
            }
          }
          lastNumber = cur.number;
        }
        for(var i = 0;i<totalSweets;i++){
          if(this.sweetStash==0){
            break;
          }
          this.addSweetToPlayer();
        }
        //Move cards from present to PAST
        var card;
        while(this.present.list.length!==0){
          card = this.present.drawCard();
          card.removeSweetFromCard();
          this.past.addCardBottom(card);
        }
        //Move cards from past to bottom of deck until there are 3 cards in the past
        while(this.past.list.length>3){
          this.deck.addCardBottom(this.past.drawCard());
        }
        this.beginTurn();
    }

    getShortAction(action){
      switch(action){
        case 'addSweet':
          return "TS";
        break;
        case 'coffee':
          return "C!";
        break;
        case 'drawCard':
          return 'D'
        break;
        case 'presentBelowStack':
          return "BS";
        break;
        case 'cardsIntoPast':
          return "CiP";
        break;
        case 'cardsFromPast':
          return "CfP";
        break;
        case 'oneCardToFuture':
          return "oCF"
        break;
        case 'allCardsToFuture':
          return "aCF"
        break;
        case 'exchangeCards':
          return "EC"
        break;
        case 'removeSweets':
          return "RS"
        break;
      }
    }

    showGameState(){
      console.log("--------------------------------------");
      console.log("NEXT CARD TO SCORE: "+this.finished.nextScore());
      console.log("COFFEE LEFT: "+this.coffee);
      console.log ("-+-+-  FUTURE   +-+-+-+-+-+-+-+-+-+-+");
      if(this.future.listOfCardLists.length==0){
         this.displayCards({list:[]});
      }else if(this.future.listOfCardLists.length==1){
          this.displayCards(this.future.listOfCardLists[0]);
      }else{
        console.log("OHH SORRY; HAVENT PROGRAMMED THIS");
      }
      console.log ("-+-+-  PRESENT  +-+-+-+-+-+-+-+-+-+-+");
      this.displayCards(this.present);
      console.log ("-+-+-  PAST     +-+-+-+-+-+-+-+-+-+-+");
      this.displayCards(this.past);
      console.log ("-+-+-  SWEETS   +-+-+-+-+-+-+-+-+-+-+");
      this.displaySweets();
      console.log("--------------------------------------");
      this.displayCommands();
    }
    displayCommands(){
      console.log("OPTIONS MENU: ");
      console.log("game.menu(1): Activate a card");
      console.log("game.menu(2): Reorder cards");
      console.log("game.menu(3): End turn");
      console.log("game.menu(4): Glossary");
      console.log("game.menu(5): Rules");
      console.log("game.menu(6): Show game state");
    }
    menu(n){
      switch(n){
        case 1:
          this.activateMenu();
        break;
        case 2:
          this.reorderMenu();
        break;
        case 3:
          this.endTurn()
        break;
        case 4:

        break;
        case 5:

        break;
        case 6:
          this.showGameState();
        break;
        default:
          console.log("Invalid action");
        break;
      }
    }

    activateMenu(){
      console.log("Select a card to activate: ");
      var txt = "";
      for(var i = 0;i<this.present.list.length;i++){
          txt = "";
          for(var j = 0;j<this.present.list[i].actionList.length;j++){
            if(this.present.list[i].actionList[j].activated==0&&this.present.list[i].actionList[j].action!="addSweet"){
              console.log("game.activate("+this.present.list[i].number+"): "+this.present.list[i].actionList[j].action);
            }
          }
      }
      console.log("game.activate(x): Back");
    }

    activate(n){
      if(n=='x'){
        this.showGameState();
        return;
      }
      for(var i = 0;i<this.present.list.length;i++){
          if(this.present.list[i].number==n){
            for(var j = 0;j<this.present.list[i].actionList.length;j++){
              if(this.present.list[i].actionList[j].activated==0){
                this.present.list[i].actions[this.present.list[i].actionList[j].action]();
                return;
              }
            }
          }
      }
    }

    reorderMenu(){
        console.log("Select two cards to switch places:");
        console.log("game.move(cardOne, cardTwo)");
        for(var i = 0;i<this.present.list.length;i++){
            console.log(this.present.list[i].number);
        }
        console.log("game.move('s'): Sort in ascending order");
        console.log("game.move('x'): Back");
    }


    move(one, two){
        var cardOne, cardTwo
        if(one=='s'||one=='x'){
          if(one=='s'){
            this.present.sort();
          }
          this.showGameState();
          return;
        }
        if(one==two){
          return;
        }

        for(var i = 0;i<this.present.list.length;i++){
          if(this.present.list[i].number==one){
            cardOne = i
          }
          if(this.present.list[i].number==two){
            cardTwo = i
          }
          if(cardOne!==undefined&&cardTwo!==undefined){
            break;
          }
        }
        if(cardOne!==undefined&&cardTwo!==undefined){
            var temp = this.present.list[cardOne];
            this.present.list[cardOne] = this.present.list[cardTwo];
            this.present.list[cardTwo] = temp;
            console.log("Switched cards ["+one+"] and ["+two+"]");
        }else{
          if(cardOne==undefined){
            console.log("Card ["+one+"] not found in present");
          }
          if(cardTwo==undefined){
            console.log("Card ["+two+"] not found in present");
          }
        }
        this.showGameState();
    }

    makeDeck(){
      this.deck.addCardTop(new Card(1, []));
      this.deck.addCardTop(new Card(2, ['drawCard2']));
      this.deck.addCardTop(new Card(3, ['addSweet']));
      this.deck.addCardTop(new Card(4, ['presentBelowStack']));
      this.deck.addCardTop(new Card(5, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(6, ['addSweet']));
      this.deck.addCardTop(new Card(7, ['presentBelowStack']));
      this.deck.addCardTop(new Card(8, ['cardsFromPast']));
      this.deck.addCardTop(new Card(9, ['drawCard1']));
      this.deck.addCardTop(new Card(10, ['addSweet']));
      this.deck.addCardTop(new Card(11, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(12, ['oneCardToFuture']));
      this.deck.addCardTop(new Card(13, ['exchangeCards']));
      this.deck.addCardTop(new Card(14, ['drawCard1']));
      this.deck.addCardTop(new Card(15, ['addSweet']));
      this.deck.addCardTop(new Card(16, ['allCardsToFuture']));
      this.deck.addCardTop(new Card(17, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(18, ['cardsFromPast']));
      this.deck.addCardTop(new Card(19, ['oneCardToFuture']));
      this.deck.addCardTop(new Card(20, ['drawCard1']));
      this.deck.addCardTop(new Card(21, ['addSweet']));
      this.deck.addCardTop(new Card(22, ['exchangeCards']));
      this.deck.addCardTop(new Card(23, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(24, ['allCardsToFuture']));
      this.deck.addCardTop(new Card(25, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(26, ['allCardsToFuture']));
      this.deck.addCardTop(new Card(27, ['drawCard1']));
      this.deck.addCardTop(new Card(28, ['addSweet']));
      this.deck.addCardTop(new Card(29, ['presentBelowStack']));
      this.deck.addCardTop(new Card(30, ['cardsFromPast']));
      this.deck.addCardTop(new Card(31, ['drawCard1']));
      this.deck.addCardTop(new Card(32, ['oneCardToFuture']));
      this.deck.addCardTop(new Card(33, ['exchangeCards']));
      this.deck.addCardTop(new Card(34, ['drawCard1']));
      this.deck.addCardTop(new Card(35, ['allCardsToFuture']));
      this.deck.addCardTop(new Card(36, ['addSweet']));
      this.deck.addCardTop(new Card(37, ['removeSweets']));
      this.deck.addCardTop(new Card(38, ['allCardsToFuture']));
      this.deck.addCardTop(new Card(39, ['exchangeCards']));
      this.deck.addCardTop(new Card(40, ['oneCardToFuture']));
      this.deck.addCardTop(new Card(41, ['cardsIntoPast']));
      this.deck.addCardTop(new Card(42, ['presentBelowStack']));
      this.deck.addCardTop(new Card(43, ['exchangeCards']));
      this.deck.addCardTop(new Card(44, ['cardsFromPast']));
      this.deck.addCardTop(new Card(45, ['addSweet']));
      this.deck.addCardTop(new Card(46, ['drawCard1']));
      this.deck.addCardTop(new Card(47, ['drawCard1', 'drawCard1', 'drawCard1']));
      this.deck.shuffle();
      this.deck.addCardBottom(new Card (48, ['coffee']));
    }

    addSweetToStash(){
      this.sweetStash++;
    }

    addSweetToPlayer(){
      if(this.sweetStash>0){
          var top = "", mid = "", bot = "";
            top += "  -------       + ";
            mid += ">---------<   +++++";
            bot += "  -------       + ";
          console.log(top);
          console.log(mid);
          console.log(bot);
          this.sweetStash--;
          this.sweetPlayer++;
      }else{
        console.log("NO MORE SWEETS IN STASH!");
      }
    }

    displaySweets(){
      var top = "";
      var mid = "";
      var bot = "";
      for(var i = 0;i<this.sweetPlayer;i++){
        top += "  -------   ";
        mid += ">---------< ";
        bot += "  -------   ";
      }
      console.log(top);
      console.log(mid);
      console.log(bot);
    }

    displayCards(cardList){
      var list = cardList.list, txt = "";
      var txt1 = "", txt2 = "",  txt3 = "", txt4 = "", txt5 = "", temp = "";
      for(var i = 0;i<list.length;i++){
        temp = "";
        txt1+= "------ ";
        if(list[i].number<10){
          txt2+= "-  "+list[i].number+" - ";
        }else{
          txt2+= "- "+list[i].number+" - ";
        }
        for(var j = 0;j<list[i].actionList.length;j++){
            temp += this.getShortAction(list[i].actionList[j].action);
            if(list[i].actionList[j].action=="drawCard"){
              temp += list[i].actionList[j].draw;
            }
            //console.log(list[i].actionList[j]);
            if(list[i].actionList[j].activated==1){
              temp += String.fromCharCode(632);
            }
        }
        txt3+= "------ ";
        txt4+= "-";
        txt4+= temp;
        for(var j=0;j<4-temp.length;j++){
          txt4+= " ";
        }
        txt4+= "- ";
        txt5+= "------ ";
      }
      console.log(txt1);
      console.log(txt2);
      console.log(txt3);
      console.log(txt4);
      console.log(txt5);
    }
    displayCoffee(){
      /*
          console.log("               .           ")6
          console.log("            .  .           ")5 4
          console.log("          . . .            ")3 2 1
          console.log("    ||------------|        ")6
          console.log("    ||            ||||||   ")5
          console.log("    ||            |    ||  ")4
          console.log("    ||            |    ||  ")3
          console.log("    ||            |    ||  ")2
          console.log("    ||            ||||||   ")1
          console.log("    |||||||||||||||        ")0
      /**/
    }
    coffee(){
      this.coffee--;
      displayCoffee();
      if(this.coffee===0){
        console.log("     WARNING! COFFEE DEPLETED!   ");
      }else if(this.coffee===-1){
        console.log("     YOU FELL ASLEEP :(    ");
      }
    }

    presentBelowStack(){
      this.present.sort();
      var card;
      while(this.present.list.length>0){
        card = this.present.drawCard();
        card.removeSweetFromCard();
        this.deck.addCardBottom(card);
      }
      this.endTurn();
    }

    cardsIntoPast(){
        var cards = this.present.getSelectedCards();
        for(var i = 0;i<cards.length;i++){
          cards[i].removeSweetFromCard();
          this.past.addCardBottom(cards[i]);
        }
        for(var i = 0;i<cards.length;i++){
          this.drawCardFromDeck();
        }
    }

    cardsFromPast(){
        for(var i = 0;i<=2;i++){
          if(this.past.list.length>0){
              this.present.addCardBottom(this.past.drawCardFromBottom());
          }
        }
    }

    oneCardToFuture(){
        var cards = this.present.getSelectedCards();
        for(var i = 0;i<cards.length;i++){
          this.nextTurnCards.addCardTop(cards[i]);
        }
    }

    allCardsToFuture(){
        var cardList = new cardList();
        while(this.present.list.length!=0){
            cardList.addCardTop(this.present.drawCard());
        }
        this.future.listOfCardLists.push(cardList);
    }

    exchangeCards(){
        this.drawCardFromDeck();
        selectCardsFromPresent(1);
    }

    removeSweets(){
        this.present.removeSweets();
        for(var i = 0;i<this.future.listOfCardLists.length;i++){
          this.future.listOfCardLists[i].removeSweets();
        }
    }
    selectCardsFromPresent(n){
      console.log("SELECT ["+n+"] CARD"+(n==1?'':'S')+" FROM THE PRESENT");

    }
  }

var game = new Game();
//game.beginGame();
