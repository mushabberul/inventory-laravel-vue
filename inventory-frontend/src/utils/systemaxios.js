import axios from "axios";
import config from "./config";

const baseClient = {
    baseURL: config.inventoryAPIHost,
    header:{
        "Accept":"application/json",
        "Content-type":"application/json",
        "X-Requestd-With":"XMLHttpRequest"
    }
}

const inventoryAxiosClient = {
    baseURL: config.inventoryAPIHost,
    header:{
        "Accept":"application/json",
        "Content-type":"application/json",
        "X-Requested-With":"XMLHttpRequest"
    },
    "Autharization":"Bearer"+config.apiToken
}

export{
    baseClient,
    inventoryAxiosClient
}