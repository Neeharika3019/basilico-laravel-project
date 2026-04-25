<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Special;
use App\Models\Testimonial;

class HomepageController extends Controller
{
    public function index()
    {
        $specials = Special::all();

        return view('homepage.homepage', compact('specials'));
    }

    public function checkReservationAvailability(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'guests' => 'required|integer|min:1'
        ]);

        $time = $request->reservation_time;
        $guests = $request->guests;

        if ($guests > 8) {
            return response()->json([
                'available' => false,
                'message' => 'Sorry, online reservation is available for up to 8 guests only.'
            ]);
        }

        if ($time < '10:00' || $time > '22:00') {
            return response()->json([
                'available' => false,
                'message' => 'Reservations are only available between 10:00 and 22:00.'
            ]);
        }

        return response()->json([
            'available' => true,
            'message' => 'Great! This reservation slot looks available.'
        ]);
    }

    public function getTestimonials()
    {
        $testimonials = Testimonial::latest('id')->get();

        return response()->json($testimonials);
    }

    public function testSchema()
    {
        $schemaPath = storage_path('app/schemas/testimonial-schema.json');

        if (!file_exists($schemaPath)) {
            return response()->json([
                'valid' => false,
                'message' => 'Schema file not found.'
            ], 404);
        }

        $schema = json_decode(file_get_contents($schemaPath), true);

        if (!$schema) {
            return response()->json([
                'valid' => false,
                'message' => 'Schema file is invalid JSON.'
            ], 400);
        }

        $testimonial = [
            'id' => 1,
            'username' => 'Username',
            'rating' => 5,
            'text' => 'Great food and excellent service.',
            'created_at' => '2025-11-24 21:24:11'
        ];

        foreach ($schema['required'] as $field) {
            if (!array_key_exists($field, $testimonial)) {
                return response()->json([
                    'valid' => false,
                    'message' => "Missing required field: {$field}"
                ], 422);
            }
        }

        $properties = $schema['properties'];

        foreach ($properties as $field => $rules) {
            if (!isset($testimonial[$field])) {
                continue;
            }

            $value = $testimonial[$field];
            $expectedType = $rules['type'];

            $typeValid = match ($expectedType) {
                'integer' => is_int($value),
                'string' => is_string($value),
                default => true
            };

            if (!$typeValid) {
                return response()->json([
                    'valid' => false,
                    'message' => "Invalid type for field: {$field}. Expected {$expectedType}."
                ], 422);
            }
        }

        return response()->json([
            'valid' => true,
            'message' => 'JSON matches the expected schema structure.',
            'schema_file' => 'storage/app/schemas/testimonial-schema.json',
            'validated_data' => $testimonial
        ]);
    }
}