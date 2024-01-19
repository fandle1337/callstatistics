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

export function toMinuteWithSeconds(seconds) {
    const minutes = Math.floor(seconds / 60)
    const remainingSeconds = seconds % 60

    let result = ""

    if (minutes > 0) {
        result += minutes + " минут "
    }

    if (remainingSeconds > 0) {
        result += remainingSeconds + " секунда"
    }

    return result.trim()
}
