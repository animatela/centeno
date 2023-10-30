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
        body_type: string | null
        maker: string | null
        model: string | null
        color: number | null
        year: string | null
        fuel_type: number | string
        transmission_type: number | string
        plate: string | null
        mileage: string | null
        is_visible: number | null
        sort: string | null
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
