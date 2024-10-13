export interface User {
    id: number;
    firstname: string;
    lastname: string;
    email: string;
    type: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
