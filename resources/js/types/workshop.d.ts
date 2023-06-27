declare namespace Workshop {
    export interface Service {
        id: number
        name: string
        description: string
    }

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
        id: number
        number: string
        currency: string
        reservation_date: string
        reservation_time: string
        price: number
        status: string
        notes: string
        created_at?: string
        updated_at?: string
        deleted_at?: string

        customer_id: number
        vehicle_id: number
        service_id: number
    }
}
