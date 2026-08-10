export type AuthChild = {
    id: number;
    email: string;
    bonus_points: number;
    available_points: number;
};

export type AuthAdmin = {
    id: number;
    login: string;
};

export type Auth = {
    child: AuthChild | null;
    admin: AuthAdmin | null;
};

export type Flash = {
    success: string | null;
    error: string | null;
};
