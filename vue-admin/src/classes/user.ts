import {Role} from "@/classes/role";
import {Entity} from "@/interfaces/entity";

export class User implements Entity {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    role: Role;
    permisiions: string[];

    constructor(id = 0, first_name = '', last_name = '', email = '', role = new Role(), permissions = []) {
        this.id = id;
        first_name: string;
        last_name: string;
        email: string;
        role: Role;
        this.permissions = permissions;
    }
}