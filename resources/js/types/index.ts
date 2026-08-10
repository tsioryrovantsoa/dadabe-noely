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

export type Category = {
    id: number;
    name: string;
};

export type Gift = {
    id: number;
    name: string;
    points: number;
    image: string | null;
    category: Category;
};

export type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

export type Paginated<T> = {
    data: T[];
    links: PaginationLink[];
    from: number | null;
    to: number | null;
    total: number;
};

export type GiftFilters = {
    name?: string | null;
    category_id?: number | null;
    min_points?: number | null;
    max_points?: number | null;
};
