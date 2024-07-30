import { alpha_spaces, min_value } from '@vee-validate/rules';
import {
    Form as VeeForm,
    Field as VeeField,
    ErrorMessage,
    configure
} from 'vee-validate';

import {
    required,
    max,
    min,
    email,
    confirmed,
    checkbox,
    alpha_spaces as alphaSpaces,
    max_value as maxVal,
    min_value as minVal,
    not_one_of as excluded
} from 'vee-validate/rules'

export default{
    install(app){
        app.component(`VeeForm`,VeeForm);
        app.component(`VeeField`,VeeField);
        app.component(`EroorMessage`,ErrorMessage);

        defineRule(`required`,required);
        defineRule(`max`,max);
        defineRule(`min`,min);
        defineRule(`email`,email);
        defineRule(`alpha_spaces`,alphaSpaces);
        defineRule(`min_val`,minVal);
        defineRule(`checkbox`,checkbox);
        defineRule(`max_val`,maxVal);
        defineRule(`excluded`,excluded);
        defineRule(`password_mismatch`,confirmed);

        configure({
            generateMessage:(ctx)=>{
                const message ={
                    required:`The field ${ctx.field} is required`,
                    email:`The field ${ctx.field} is required`,
                    max:`The field ${ctx.field} is too long`,
                    min:`The field ${ctx.field} is too short`,
                    alpha_spaces:`The field ${ctx.field} may only contains alpha numirical caractar`,
                    min_value:`The field ${ctx.field} is to low`,
                    max_value:`The field ${ctx.field} is to high`,
                    excluded:` You are not allowed to use this value for the field ${ctx.field}`,
                    password_mismatch:`The password don't match`,
                    checkbox:`You must check a tarms of service`,
                }
            }
        });
    }
}