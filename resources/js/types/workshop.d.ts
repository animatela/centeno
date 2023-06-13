declare namespace Workshop {
    export interface Customer {
        id: number
        name?: string
        email?: string
        phone?: string
        gender?: string
        birthday?: string
        photo?: string
        document_type?: string
        document_number?: string
        created_at?: string
        updated_at?: string
        deleted_at?: string

        user_id?: number
    }

    export interface Vehicle {
        name: string
        body_type?: string
        model?: string
        year?: string
        color?: number
        fuel_type?: string
        transmission_type?: number
        plate?: string
        mileage?: string
        is_visible?: number
        sort?: string
    }
}
