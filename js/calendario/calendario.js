const date = new Date();

const renderCalender = () => {


    date.setDate(1)

    //seleciona o dia de forma dinâmica
    const monthDays = document.querySelector('.days');

    //define o ultimo dia do mes atual
    const lastDay = new Date(date.getFullYear(),date.getMonth() + 1, 0).getDate();

    //define os dias do mes anterior
    const prevLastDay = new Date(date.getFullYear(),date.getMonth(), 0).getDate();

    //define o primeiro dia do mes atual
    const firstDayIndex = date.getDay();

    //define o ultimo dia do mes atual
    const lastDayIndex = new Date(date.getFullYear(),date.getMonth()+1, 0).getDay();

    const nextDays = 7 - lastDayIndex - 1;


    //Array que define os meses - Para nomes em inglês basta substituir 
    const months = [
        "Janeiro", 
        "Fevereiro", 
        "Março", 
        "Abril", 
        "Maio", 
        "Junho", 
        "Julho", 
        "Agosto", 
        "Setembro", 
        "Outubro", 
        "Novembro", 
        "Dezembro", 
    ];

    //seleciona o mês de forma dinâmica
    document.querySelector('.date h1').innerHTML = months[date.getMonth()];

    //retorna a data atual no calêndario com base no idioma local
    document.querySelector('.date p').innerHTML = new Date().toLocaleDateString();


    let days = "";

    //loop que escreve os dias do mes anterior
    for(let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }

    // loop for que escreve os dias do mês atual
    for(let i = 1; i <= lastDay; i++) {
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
            days += `<div class="today">${i}</div>`; 
        } else {
            days += `<div>${i}</div>`;
        }  
    }

    //loop que escreve os dias do próximo mês
    for(let j = 1;  j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }
}


//funcionamento das setas

document.querySelector('.prev').addEventListener('click',() => {
    date.setMonth(date.getMonth() - 1);
    renderCalender();

});

document.querySelector('.next').addEventListener('click',() => {
    date.setMonth(date.getMonth() + 1);
    renderCalender();
});

renderCalender();