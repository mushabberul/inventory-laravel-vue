function getYears(startYear){
    let currentYear = new Date().getFullYear();
    let years = [];

    for(let index=startYear; index <= currentYear; index++){
       years.push(startYear++);
    }

    return years;
}

const getMonths = ()=>{
    const monthNames = [];
    for (let i = 0; i < 12; i++) {
    const date = new Date(0, i);
    const monthName = date.toLocaleString('default', { month: 'long' });
    monthNames.push(monthName);
    }
    return monthNames;

}

export {
    getYears,
    getMonths
}