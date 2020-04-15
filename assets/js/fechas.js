const datetimeFormat = "dd/MM/yyyy H:i";
const dateFormat = "dd/MM/yyyy";

function formatDatetime(date)
{
    const day = Number(date.substring(0, 2)); 
    const month = Number(date.substring(3, 5));
    const year = Number(date.substring(6, 10));

    const hour = Number(date.substring(11, 13));    
    const minute = Number(date.substring(14, 16));
    return new Date(year, month - 1, day, hour, minute, 0);
}

function formatDate(date)
{
    const day = Number(date.substring(0, 2)); 
    const month = Number(date.substring(3, 5));
    const year = Number(date.substring(6, 10));
    return new Date(year, month - 1, day);
}

function stringToDatetime(string){
  return formatDatetime(string);
}

function stringToDate(string){
  return formatDate(string);
}