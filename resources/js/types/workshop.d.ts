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
        id: number
        name: string
        body_type?: string
        maker?: string
        model?: string
        color?: number
        year?: string
        fuel_type?: string
        transmission_type?: number
        plate?: string
        mileage?: string
        is_visible?: number
        sort?: string
    }

    export interface Reservation {
        int: int
        number: string
        currency: string
        date_time: Carbon
        price: float
        status: string
        created_at?: string
        updated_at?: string
        deleted_at?: string

        vehicle_id: int
        service_id: int
    }
}
