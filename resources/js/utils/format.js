export function currency(value, currency) {
    if (currency === 'RUR') {
        currency = 'RUB'
    }
    return (new Intl.NumberFormat("ru", {style: "currency", currency: currency}).format(value))
}

export function timeFormat(seconds) {
    return (new Date(seconds * 1000).toISOString().substr(11, 8))
}

export function toFixedUp(x, digits)  {
    const factor = 10 ** digits;
    return (Math.round(x * factor + 0.5) / factor).toFixed(digits);
}

export function toMinute(seconds) {
    const minutes = Math.floor(seconds / 60);

    if (minutes === 0) {
        return "менее минуты";
    }

    return '~' + formatUnit(minutes, "минута", "минуты", "минут");
}

export function formatTime(seconds) {
    if (isNaN(seconds) || seconds < 0) {
        return "Некорректное значение";
    }

    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;

    const hoursString = formatUnit(hours, "час", "часа", "часов");
    const minutesString = formatUnit(minutes, "минута", "минуты", "минут");
    const secondsString = formatUnit(remainingSeconds, "секунда", "секунды", "секунд");

    let result = "";

    if (hours > 0) {
        result += hoursString;
    }

    if (minutes > 0) {
        result += (result ? " " : "") + minutesString;
    }

    if (remainingSeconds > 0 || result === "") {
        result += (result ? " " : "") + secondsString;
    }

    return result;
}

function formatUnit(value, one, few, many) {
    if (value === 1) {
        return `${value} ${one}`;
    } else if (value > 1 && value < 5) {
        return `${value} ${few}`;
    } else {
        return `${value} ${many}`;
    }
}
